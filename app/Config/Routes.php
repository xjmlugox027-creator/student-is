<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('', ['filter' => 'auth'], function ($routes) {
    //admin access
    $routes->group('', ['filter' => 'role:admin'], function ($routes) {
        $routes->get('dashboard', 'StudentController::dashboardPage');

        //register user
        $routes->get('users', 'UserController::users');
        $routes->post('users', 'UserController::register');

        //update user
        $routes->post('users/(:num)', 'UserController::updateUser/$1');
    });

    //user access
    $routes->group('', ['filter' => 'role:user'], function ($routes) {
        $routes->get('user', 'StudentController::dashboardPage');
    });

    //logout
    $routes->get('logout', 'UserController::logout');

    $routes->get('students', 'StudentController::studentsPage');
    $routes->post('students', 'StudentController::addStudent');

    $routes->get('(:num)', 'StudentController::deleteStudent/$1');
    $routes->post('/edit/(:num)', 'StudentController::updateStudent/$1');
});

$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('/login', 'StudentController::login');
    $routes->post('/login', 'UserController::login');
});
