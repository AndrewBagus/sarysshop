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
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('login', 'LoginController::index');
// $routes->post('user/getByUserId', 'UserController::getByUserId');
$routes->group(
  '',
  ['filter' => 'guest'],
  static function ($routes) {
    $routes->get('login', 'LoginController::index');
    $routes->post('login/login', 'LoginController::login');
  }
);

$routes->group(
  '',
  ['filter' => 'auth'],
  static function ($routes) {
    $routes->get('/', 'HomeController::index');
    $routes->get('/logout', 'LoginController::logout');

    $routes->get('/jenis-bank', 'JenisBankController::index');
    $routes->post('/jenisBank/getDataTable', 'JenisBankController::getDataTable');
    $routes->post('/jenisBank/getJenisBank', 'JenisBankController::getJenisBank');
    $routes->post('/jenisBank/saveData', 'JenisBankController::saveData');
    $routes->post('/jenisBank/removeData', 'JenisBankController::removeData');

    $routes->get('/kategori-produk', 'KategoriProdukController::index');
    $routes->post('/kategoriProduk/getDataTable', 'KategoriProdukController::getDataTable');
    $routes->post('/kategoriProduk/getKategoriProduk', 'KategoriProdukController::getKategoriProduk');
    $routes->post('/kategoriProduk/saveData', 'KategoriProdukController::saveData');
    $routes->post('/kategoriProduk/removeData', 'KategoriProdukController::removeData');

    $routes->get('/kategori-pelanggan', 'KategoriPelangganController::index');
    $routes->post('/kategoriPelanggan/getDataTable', 'KategoriPelangganController::getDataTable');
    $routes->post('/kategoriPelanggan/getKategoriPelanggan', 'KategoriPelangganController::getKategoriPelanggan');
    $routes->post('/kategoriPelanggan/saveData', 'KategoriPelangganController::saveData');
    $routes->post('/kategoriPelanggan/removeData', 'KategoriPelangganController::removeData');

    $routes->get('/bank', 'BankController::index');
    $routes->post('/bank/getDataTable', 'BankController::getDataTable');
    $routes->post('/bank/getBank', 'BankController::getBank');
    $routes->post('/bank/saveData', 'BankController::saveData');
    $routes->post('/bank/removeData', 'BankController::removeData');

    $routes->get('/pelanggan', 'PelangganController::index');
    $routes->post('/pelanggan/getDataTable', 'PelangganController::getDataTable');
    $routes->post('/pelanggan/getPelanggan', 'PelangganController::getPelanggan');
    $routes->post('/pelanggan/saveData', 'PelangganController::saveData');
    $routes->post('/pelanggan/removeData', 'PelangganController::removeData');

    $routes->post('/kelurahan/getKelurahan', 'KelurahanController::getKelurahan');
    $routes->post('/kelurahan/getKelurahanById', 'KelurahanController::getKelurahanById');
  }
);

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
