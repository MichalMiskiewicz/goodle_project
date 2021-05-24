<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index', 'DefaultController');
Routing::get('products', 'DefaultController');
Routing::get('favourites', 'DefaultController');
Routing::get('addproduct', 'DefaultController');
Routing::get('registration', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::get('addproduct', 'ProductController');

Routing::run($path);