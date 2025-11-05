<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'loginGuard']);

service('auth')->routes($routes);

// $routes->get('/admin', 'DashboardController::index', ['filter' => 'session']);

$routes->group('admin', ['filter' => 'session'], static function ($routes) {
    $routes->get('/', 'DashboardController::index');

    // profile
    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update', 'ProfileController::update');

    // pendidikan
    $routes->get('pendidikan', 'EducationController::index');
    $routes->get('pendidikan/tambah', 'EducationController::create');
    $routes->post('pendidikan/store', 'EducationController::store');
    $routes->get('pendidikan/edit/(:num)', 'EducationController::edit/$1');
    $routes->post('pendidikan/update/(:num)', 'EducationController::update/$1');
    $routes->delete('pendidikan/delete/(:num)', 'EducationController::delete/$1');
});
