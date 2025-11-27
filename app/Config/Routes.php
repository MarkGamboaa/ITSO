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
$routes->post('users/update/(:any)', 'Users::update/$1');
$routes->get('users/deactivate/(:any)', 'Users::deactivate/$1');
$routes->post('users/confirmDeactivate/(:any)', 'Users::confirmDeactivate/$1');
$routes->get('users/registrationConfirmation/(:any)', 'Users::registrationConfirmation/$1');
$routes->get('users/verificationConfirmation/(:any)', 'Users::verificationConfirmation/$1');
// ITSO module routes (UI only — no DB actions)
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/login', 'Auth::index');
$routes->get('auth/reset', 'Auth::reset');
$routes->post('auth/send_reset_link', 'Auth::send_reset_link');
$routes->get('auth/reset_password_form', 'Auth::reset_password_form');
$routes->post('auth/update_password', 'Auth::update_password');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('equipment', 'Equipment::index');
$routes->get('equipment/add', 'Equipment::add');
$routes->get('equipment/edit/(:any)', 'Equipment::edit/$1');
$routes->get('equipment/view/(:any)', 'Equipment::view/$1');
$routes->post('equipment/insert', 'Equipment::insert');
$routes->get('equipment/deactivate/(:any)', 'Equipment::deactivate/$1');
$routes->post('equipment/deactivate/(:any)', 'Equipment::deactivate/$1');

$routes->get('borrowing', 'Borrowing::index');
$routes->get('borrowing/borrow', 'Borrowing::borrow');
$routes->get('borrowing/history', 'Borrowing::history');

$routes->get('returns', 'Returns::index');
$routes->get('returns/process', 'Returns::process');
$routes->post('returns/completeReturn', 'Returns::completeReturn');

$routes->get('reservations', 'Reservations::index');
$routes->get('reservations/reserve', 'Reservations::reserve');
$routes->post('reservations/reserve', 'Reservations::reserve');
$routes->post('reservations/insert', 'Reservations::insert');
$routes->get('reservations/confirm/(:any)', 'Reservations::confirm/$1');
$routes->get('reservations/manage', 'Reservations::manage');
$routes->post('reservations/cancel/(:num)', 'Reservations::cancel/$1');
$routes->get('reservations/reschedule/(:num)', 'Reservations::reschedule/$1');
$routes->post('reservations/updateSchedule/(:num)', 'Reservations::updateSchedule/$1');
$routes->get('reservations/confirmationView', 'Reservations::confirmationView');

$routes->get('reports', 'Reports::index');
$routes->get('reports/activeEquipment', 'Reports::activeEquipment');
$routes->get('reports/unusableEquipment', 'Reports::unusableEquipment');
$routes->get('reports/userHistory', 'Reports::userHistory');

$routes->get('about', 'About::index');

// 'itso/' aliases for compatibility
$routes->get('itso/users', 'Users::index');
$routes->post('itso/users/update/(:any)', 'Users::update/$1');
$routes->get('itso/users/register', 'Users::register');
$routes->post('itso/users/register', 'Users::insert');
$routes->post('itso/users/insert', 'Users::insert');
$routes->get('itso/users/view/(:any)', 'Users::view/$1');
$routes->get('itso/users/edit/(:any)', 'Users::edit/$1');
$routes->get('itso/users/deactivate/(:any)', 'Users::deactivate/$1');
$routes->post('itso/users/confirmDeactivate/(:any)', 'Users::confirmDeactivate/$1');
$routes->get('itso/users/activate/(:any)', 'Users::activate/$1');
$routes->post('itso/users/confirmActivate/(:any)', 'Users::confirmActivate/$1');
$routes->get('itso/users/registrationConfirmation/(:any)', 'Users::registrationConfirmation/$1');
$routes->get('itso/users/verificationConfirmation/(:any)', 'Users::verificationConfirmation/$1');

$routes->post('itso/auth/login', 'Auth::login');   
$routes->get('itso/auth/login', 'Auth::index');    
$routes->get('itso/auth/index', 'Auth::index');
$routes->get('auth/verify/(:any)', 'Users::verify/$1');
$routes->get('itso/auth/verify/(:any)', 'Users::verify/$1');
$routes->get('itso/auth/reset', 'Auth::reset');
$routes->post('itso/auth/reset', 'Auth::reset');
$routes->post('itso/auth/send_reset_link', 'Auth::send_reset_link');
$routes->get('itso/auth/reset_password_form', 'Auth::reset_password_form');
$routes->post('itso/auth/update_password', 'Auth::update_password');
$routes->get('itso/auth/logout', 'Auth::logout');


$routes->get('itso/equipment', 'Equipment::index');
$routes->get('itso/equipment/add', 'Equipment::add');
$routes->get('itso/equipment/edit/(:any)', 'Equipment::edit/$1');
$routes->get('itso/equipment/view/(:any)', 'Equipment::view/$1');
$routes->post('itso/equipment/insert', 'Equipment::insert');
$routes->get('itso/equipment/deactivate/(:any)', 'Equipment::deactivate/$1');
$routes->post('itso/equipment/deactivate/(:any)', 'Equipment::deactivate/$1');

$routes->get('itso/borrowing', 'Borrowing::index');
$routes->get('itso/borrowing/borrow', 'Borrowing::borrow');
$routes->get('itso/borrowing/history', 'Borrowing::history');
$routes->post('itso/borrowing/insert', 'Borrowing::insert');

$routes->get('itso/returns', 'Returns::index');
$routes->get('itso/returns/process', 'Returns::process');
$routes->post('itso/returns/completeReturn', 'Returns::completeReturn');

$routes->get('itso/reservations', 'Reservations::index');
$routes->get('itso/reservations/reserve', 'Reservations::reserve');
$routes->post('itso/reservations/reserve', 'Reservations::reserve');
$routes->post('itso/reservations/insert', 'Reservations::insert');
$routes->get('itso/reservations/confirm/(:any)', 'Reservations::confirm/$1');
$routes->get('itso/reservations/manage', 'Reservations::manage');
$routes->post('itso/reservations/cancel/(:num)', 'Reservations::cancel/$1');
$routes->get('itso/reservations/reschedule/(:num)', 'Reservations::reschedule/$1');
$routes->post('itso/reservations/updateSchedule/(:num)', 'Reservations::updateSchedule/$1');
$routes->get('itso/reservations/confirmationView', 'Reservations::confirmationView');

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
// ...existing routes...s