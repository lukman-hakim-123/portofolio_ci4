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
    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update', 'ProfileController::update');
});
