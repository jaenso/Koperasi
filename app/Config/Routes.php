<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/anggota', 'Anggota::index');
$routes->get('/anggota/tambah', 'Anggota::tambah');
$routes->delete('/anggota/(:num)', 'Anggota::delete/$1');
$routes->get('/anggota/edit/(:num)', 'Anggota::edit/$1');
$routes->post('/anggota/update/(:num)', 'Anggota::update/$1');
$routes->get('/anggota/(:segment)', 'Anggota::detail/$1');
$routes->post('/anggota/simpan', 'Anggota::simpan');

$routes->get('/fakultas', 'Fakultas::index');
$routes->get('/fakultas/tambah', 'Fakultas::tambah');
$routes->delete('/fakultas/(:num)', 'Fakultas::delete/$1');
$routes->get('/fakultas/edit/(:num)', 'Fakultas::edit/$1');
$routes->post('/fakultas/update/(:num)', 'Fakultas::update/$1');
$routes->post('/fakultas/simpan', 'Fakultas::simpan');
