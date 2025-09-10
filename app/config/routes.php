<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
*/

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

// Optional: set default route to students/index
$router->get('/', 'StudentsController::index'); // homepage now shows students

