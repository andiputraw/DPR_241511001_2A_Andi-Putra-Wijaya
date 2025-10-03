<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function() {
    return redirect()->to('/login');
});

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->resource('anggota', ['controller' => 'AnggotaController']);
    $routes->resource('komponen-gaji', ['controller' => 'KomponenGajiController']);
    $routes->get('penggajian/komponen/(:num)', 'PenggajianController::get_komponen_gaji/$1');
    $routes->resource('penggajian', ['controller' => 'PenggajianController']);
});