<?php

require_once __DIR__ . '/../app/core/Router.php';


$router = new Router();


$router->get('/', ['StudentController', 'login']);
$router->post('/login', ['StudentController', 'doLogin']);

$router->get('/dashboard', ['StudentController', 'dashboard']);
$router->get('/students', ['StudentController', 'index']);


$router->dispatch($_SERVER['REQUEST_URI']);
