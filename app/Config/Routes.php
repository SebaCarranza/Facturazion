<?php


namespace Config;

use CodeIgniter\Router\RouteCollection;


if (!function_exists('addFilter')) {
function addFilter($existingFilters = null, $newFilter = null)
{
if (!empty($existingFilters)) {
return $existingFilters . "," . $newFilter;
} else {
return $newFilter;
}
}
}

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
require SYSTEMPATH . 'Config/Routes.php';
}

/*

--------------------------------------------------------------------
Router Setup
--------------------------------------------------------------------*/
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set $autoRoutesImproved to true in app/Config/Feature.php and set the following to true.
//$routes->setAutoRoute(false);

/*

--------------------------------------------------------------------
Route Definitions
--------------------------------------------------------------------*/

// We get a performance increase by specifying the default
// route since we don't have to scan directories.




/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/validar_usuario', 'Usuarios::validar_usuario');


$routes->get('/listado_comercio', 'Comercios::listado_comercio');
$routes->get('/actualizar_listado_comercio', 'Comercios::actualizar_listado_comercio');
$routes->get('/editar_comercio', 'Comercios::editar_comercio');
$routes->get('/editar_comercio/(:any)', 'Comercios::editar_comercio/$1');
$routes->post('/borrar_comercio/(:any)', 'Comercios::borrar_comercio/$1');
$routes->post('/save_comercio', 'Comercios::save_comercio');

$routes->get('/editar_cbu/(:any)', 'Cbus::editar_cbu/$1');
$routes->get('/editar_cbu/(:any)/(:any)', 'Cbus::editar_cbu/$1/$2');
$routes->post('/save_cbu', 'Cbus::save_cbu');
$routes->post('/borrar_cbu/(:any)', 'Cbus::borrar_cbu/$1');
$routes->get('/actualizar_listado_cbu/(:any)', 'Cbus::actualizar_listado_cbu/$1');
