<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('SELECT ud.name, ud.surname, u.email, u.password
                                                            FROM users u
                                                            JOIN users_details ud
                                                            ON u.id_user_details = ud.id
                                                            WHERE email = :email;');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['name'],
            $user['surname'],
            $user['email'],
            $user['password']
        );
    }

    public function setUser(User $user) {
        $stmt = $this->database->connect()->prepare('INSERT INTO public.users_details(id, name, surname) 
                                                            VALUES (DEFAULT, :name, :surname);');
        $stmt2 = $this->database->connect()->prepare('INSERT INTO public.users(email, password, id_user_details) 
                                                            VALUES (:email, :password, (SELECT MAX(id) FROM users_details));');
        $email = $user->getEmail();
        $password = $user->getPassword();
        $name = $user->getName();
        $surname = $user->getSurname();
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt2->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt2->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $stmt2->execute();
    }
}