<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'CustomerAccounts::index');

$routes->get('/pages', 'Pages::index');
$routes->get('/about', 'Pages::about');

$routes->get('/customer-accounts', 'CustomerAccounts::index');
$routes->get('/user-accounts', 'UserAccounts::index');

$routes->get('/customers/new', 'CustomerAccounts::newForm');
$routes->post('/customers', 'CustomerAccounts::create');

$routes->get('/users/new', 'UserAccounts::newForm');
$routes->post('/users', 'UserAccounts::create');

$routes->get('/customers/(:num)/edit', 'CustomerAccounts::edit/$1');
$routes->post('/customers/(:num)', 'CustomerAccounts::update/$1');

$routes->get('/users/(:num)/edit', 'UserAccounts::edit/$1');
$routes->post('/users/(:num)', 'UserAccounts::update/$1');