<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes for Index controller
$routes->get('/', 'Index::index');

// Routes for Users controller
$routes->get('users', 'Users::index');
// User management UI pages
$routes->get('users/register', 'Users::register');
$routes->post('users/register', 'Users::insert');
$routes->get('users/view/(:any)', 'Users::view/$1');
$routes->get('users/edit/(:any)', 'Users::edit/$1');
$routes->get('users/deactivate/(:any)', 'Users::deactivate/$1');

// ITSO module routes (UI only — no DB actions)
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/login', 'Auth::index');
$routes->get('auth/reset', 'Auth::reset');

$routes->get('equipment', 'Equipment::index');
$routes->get('equipment/add', 'Equipment::add');
$routes->get('equipment/edit/(:any)', 'Equipment::edit/$1');
$routes->get('equipment/view/(:any)', 'Equipment::view/$1');
$routes->get('equipment/deactivate/(:any)', 'Equipment::deactivate/$1');

$routes->get('borrowing', 'Borrowing::index');
$routes->get('borrowing/borrow', 'Borrowing::borrow');
$routes->get('borrowing/history', 'Borrowing::history');

$routes->get('returns', 'Returns::index');
$routes->get('returns/process', 'Returns::process');

$routes->get('reservations', 'Reservations::index');
$routes->get('reservations/reserve', 'Reservations::reserve');
$routes->get('reservations/manage', 'Reservations::manage');

$routes->get('reports', 'Reports::index');
$routes->get('reports/activeEquipment', 'Reports::activeEquipment');
$routes->get('reports/unusableEquipment', 'Reports::unusableEquipment');
$routes->get('reports/userHistory', 'Reports::userHistory');

$routes->get('about', 'About::index');

// 'itso/' aliases for compatibility
$routes->get('itso/users', 'Users::index');
$routes->get('itso/users/register', 'Users::register');
$routes->post('itso/users/register', 'Users::insert');
$routes->post('itso/users/insert', 'Users::insert');
$routes->get('itso/users/view/(:any)', 'Users::view/$1');
$routes->get('itso/users/edit/(:any)', 'Users::edit/$1');
$routes->get('itso/users/deactivate/(:any)', 'Users::deactivate/$1');

$routes->post('itso/auth/login', 'Auth::login');   
$routes->get('itso/auth/login', 'Auth::index');    
$routes->get('itso/auth/index', 'Auth::index');
$routes->get('auth/verify/(:any)', 'Users::verify/$1');
$routes->get('itso/auth/verify/(:any)', 'Users::verify/$1');
$routes->get('itso/auth/reset', 'Auth::reset');
$routes->get('itso/auth/logout', 'Auth::logout');


$routes->get('itso/equipment', 'Equipment::index');
$routes->get('itso/equipment/add', 'Equipment::add');
$routes->get('itso/equipment/edit/(:any)', 'Equipment::edit/$1');
$routes->get('itso/equipment/view/(:any)', 'Equipment::view/$1');
$routes->get('itso/equipment/deactivate/(:any)', 'Equipment::deactivate/$1');

$routes->get('itso/borrowing', 'Borrowing::index');
$routes->get('itso/borrowing/borrow', 'Borrowing::borrow');
$routes->get('itso/borrowing/history', 'Borrowing::history');

$routes->get('itso/returns', 'Returns::index');
$routes->get('itso/returns/process', 'Returns::process');

$routes->get('itso/reservations', 'Reservations::index');
$routes->get('itso/reservations/reserve', 'Reservations::reserve');
$routes->get('itso/reservations/manage', 'Reservations::manage');

$routes->get('itso/reports', 'Reports::index');
$routes->get('itso/reports/activeEquipment', 'Reports::activeEquipment');
$routes->get('itso/reports/unusableEquipment', 'Reports::unusableEquipment');
$routes->get('itso/reports/userHistory', 'Reports::userHistory');

$routes->get('itso/about', 'About::index');
$routes->get('itso/main_view', 'Index::index');

// ...existing routes...
$routes->get('/products', 'Products::index');
$routes->get('/products/add', 'Products::add');
$routes->get('/products/edit/(:num)', 'Products::edit/$1');
$routes->get('/products/view/(:num)', 'Products::view/$1');
// ...existing routes...