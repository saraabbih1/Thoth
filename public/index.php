<?php
session_start();
require_once __DIR__ . '/../app/core/Router.php';

$router = new Router();

/* Student routes */
$router->get('/', ['StudentController', 'index']);
$router->get('/students', ['StudentController', 'index']);
$router->get('/students/create', ['StudentController', 'create']);
$router->post('/students/store', ['StudentController', 'store']);

$router->get('/students/edit', ['StudentController', 'edit']);
$router->post('/students/update', ['StudentController', 'update']);

$router->post('/students/delete', ['StudentController', 'delete']);
$router->get('/student/dashboard', ['StudentController', 'dashboard']);
$router->post('/student/enroll', ['StudentController', 'enroll']);

/* Authentication routes */
$router->get('/register', ['StudentController', 'register']);
$router->post('/register', ['StudentController', 'storeRegister']);
//$router->get('/login', ['StudentController', 'login']);
$router->post('/login', ['StudentController', 'storeLogin']);
$router->get('/logout', ['StudentController', 'logout']);
$router->get('/login', ['StudentController', 'login']);
$router->post('/login', ['StudentController', 'auth']);



/* Dispatch the router */
$router->dispatch($_SERVER['REQUEST_URI']);
