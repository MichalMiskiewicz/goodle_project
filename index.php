<?php

require 'Routing.php';

//session_start();


$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('products', 'ProductController');
Routing::get('favourites', 'DefaultController');
Routing::get('addproduct', 'ProductController');
Routing::get('registration', 'SecurityController');
Routing::post('login', 'SecurityController');
Routing::get('addproduct', 'ProductController');
Routing::get('logout', 'SecurityController');
Routing::post('search', 'ProductController');
Routing::get('like', 'ProductController');
Routing::get('dislike', 'ProductController');

Routing::run($path);