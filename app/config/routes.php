<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
*/

// Main students list (GUI)
$router->get('LAVACRUD/students', 'StudentsController::index');
$router->get('LAVACRUD/students/index', 'StudentsController::index');

// Create student (POST)
$router->post('LAVACRUD/students/create', 'StudentsController::create');

// Edit student form (GET)
$router->get('LAVACRUD/students/edit/{id}', 'StudentsController::edit');

// Update student (POST)
$router->post('LAVACRUD/students/update/{id}', 'StudentsController::update');

// Delete student (GET)
$router->get('LAVACRUD/students/delete/{id}', 'StudentsController::delete');

// Optional: set default route to students/index
$router->get('LAVACRUD', 'StudentsController::index');
$router->get('/', 'StudentsController::index'); // fallback
