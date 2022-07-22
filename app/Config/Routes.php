<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/search', 'Home::search');
$routes->get('/login', 'Home::login');
$routes->get('/search/(:num)', 'Home::search/$1');
$routes->get('/detail/(:num)', 'Home::detail/$1');

$routes->post('/auth/login', 'Admin\Auth::proses');
$routes->get('/logout', 'Admin\Auth::logout');

$routes->group('admin', ["filter" => "login"] , function($routes)
{
    // get request
    $routes->get('', "Admin\Home::dashboard");
    $routes->get('login', "Admin\Home::index");
    $routes->get('logout', "Admin\Auth::logout");
    $routes->get('admin', "Admin\User::index");
    $routes->get('admin/(:num)', "Admin\User::detail/$1");
    $routes->get('brand', "Admin\Brand::index");
    $routes->get('brand/(:num)', "Admin\Brand::detail/$1");
    $routes->get('banner', "Admin\Banner::index");
    $routes->get('banner/(:num)', "Admin\Banner::detail/$1");
    $routes->get('series', "Admin\Series::index");
    $routes->get('series/(:num)', "Admin\Series::detail/$1");
    $routes->get('cars', "Admin\Cars::index");
    $routes->get('cars/(:num)', "Admin\Cars::detail/$1");

    // post request
    $routes->post('admin/create', "Admin\User::create");
    $routes->post('admin/edit', "Admin\User::update");
    $routes->post('brand', "Admin\Brand::create");
    $routes->post('brand/edit', "Admin\Brand::update");
    $routes->post('banner', "Admin\Banner::create");
    $routes->post('banner/edit', "Admin\Banner::update");
    $routes->post('series', "Admin\Series::create");
    $routes->post('series/edit', "Admin\Series::update");
    $routes->post('cars', "Admin\Cars::create");
    $routes->post('cars/edit', "Admin\Cars::update");

    // delete request
    $routes->delete('admin/(:num)', "Admin\User::delete/$1");
    $routes->delete('brand/(:num)', "Admin\Brand::delete/$1");
    $routes->delete('banner/(:num)', "Admin\Banner::delete/$1");
    $routes->delete('series/(:num)', "Admin\Series::delete/$1");
    $routes->delete('cars/(:num)', "Admin\Cars::delete/$1");
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}