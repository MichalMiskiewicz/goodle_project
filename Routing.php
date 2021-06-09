<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/ProductController.php';

class Routing extends AppController {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if(!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        if(!$action){
            $action= 'index';
        }

        $id = $urlParts[1] ?? ''; //czy to integer, mapowanie czy taka wartosc mozna przekazac do danej metody z controllera
        $object->$action($id);
    }
}