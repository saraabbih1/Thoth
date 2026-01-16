<?php

require_once __DIR__ . '/../core/Router.php';

$router = new Router();

/* Students */
$router->get('/students', ['StudentController', 'index']);
$router->get('/students/create', ['StudentController', 'create']);
$router->post('/students/store', ['StudentController', 'store']);

$router->get('/students/edit', ['StudentController', 'edit']);
$router->post('/students/update', ['StudentController', 'update']);

$router->post('/students/delete', ['StudentController', 'delete']);

/* Register */
$router->get('/register', ['StudentController', 'register']);
$router->post('/register', ['StudentController', 'storeRegister']);

/* Dispatch */
$router->dispatch($_SERVER['REQUEST_URI']);
