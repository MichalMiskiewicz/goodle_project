<?php

require_once 'src/controllers/AppController.php';

class DefaultController extends AppController {
    
    public function index() {
        $this->render('login');
    }

    public function products() {
        $this->render('products');
    }

    public function favourites() {
        $this->render('favourites');
    }

    public function addproduct() {
        $this->render('addproduct');
    }

    public function registration() {
        $this->render('registration');
    }
}