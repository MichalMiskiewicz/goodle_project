<?php

require_once 'src/controllers/AppController.php';

class DefaultController extends AppController {
    
    public function index() {
        $this->render('login');
    }

    public function products() {
        parent::cookie();
        $this->render('products');
    }

    public function favourites() {
        parent::cookie();
        $this->render('favourites');
    }

    public function addproduct() {
        parent::cookie();
        $this->render('addproduct');
    }

    public function registration() {
        $this->render('registration');
    }

    public function logout() {
        $this->render('logout');
    }
}