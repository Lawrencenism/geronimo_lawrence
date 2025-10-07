<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
*/

// Authentication routes
$router->get('auth/signup', 'AuthController::signup');
$router->post('auth/signup', 'AuthController::signup');
$router->get('auth/login', 'AuthController::login');
$router->post('auth/login', 'AuthController::login');
$router->get('auth/logout', 'AuthController::logout');

// Main students list (GUI)
$router->get('students', 'StudentsController::index');
$router->get('students/index', 'StudentsController::index');

// Create student (POST)
$router->post('students/create', 'StudentsController::create');

// Edit student form (GET)
$router->get('students/edit/{id}', 'StudentsController::edit');

// Update student (POST)
$router->post('students/update/{id}', 'StudentsController::update');

// Delete student (GET)
$router->get('students/delete/{id}', 'StudentsController::delete');

// Admin routes
$router->get('admin', 'AdminController::index');
$router->get('admin/index', 'AdminController::index');
$router->get('admin/edit/{id}', 'AdminController::edit');
$router->post('admin/update/{id}', 'AdminController::update');
$router->get('admin/delete/{id}', 'AdminController::delete');

// Migration route
$router->get('migrate/run', 'MigrateController::run');

// Optional: set default route to login
$router->get('/', 'AuthController::login'); // homepage now shows login

