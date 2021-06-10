<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login(){
        $userRepository = new UserRepository();


        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $user = $userRepository->getUser($email);

        if(!$user){
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        setcookie('accept', $user->getName()." ".$user->getSurname()."@id".$user->getId());
        session_write_close();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/products");
    }

    public function logout(){
        //session_destroy();
       // $_SESSION = array();
        setcookie("accept", "", time() - 3600);
        header("Location: http://$_SERVER[HTTP_HOST]");
        exit();
    }

    public function registration(){
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('registration');
        }

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new User($name, $surname, $email, md5($password));

        $userRepository->setUser($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }
}