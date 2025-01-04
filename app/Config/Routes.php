<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home/tampil', 'Home::tampil');

$routes->get('login', 'LoginCtrl::index');
$routes->post('loginctrl/loginSubmit', 'LoginCtrl::loginSubmit'); // Menangani submit form login
$routes->get('loginctrl/logout', 'LoginCtrl::logout');           // Menangani logout
$routes->get('register', 'LoginCtrl::registerForm');   // Menampilkan form registrasi
$routes->post('register', 'LoginCtrl::registerSubmit'); // Memproses registrasi

$routes->get('adminctrl/index', 'AdminCtrl::index');
$routes->get('adminctrl/addUserForm', 'AdminCtrl::addUserForm'); // Untuk menampilkan form
$routes->post('adminctrl/addUser', 'AdminCtrl::addUser'); // Untuk proses penambahan user
$routes->get('adminctrl/list_user', 'AdminCtrl::list_user');
$routes->get('adminctrl/user_view', 'AdminCtrl::user_view');


$routes->get('pelangganctrl/index', 'PelangganCtrl::index');

$routes->get('hash-passwords', 'SetupCtrl::hashPasswords');


$routes->get('/barangctrl/index', 'BarangCtrl::index');
$routes->get('/barangctrl/tambah', 'BarangCtrl::tambah');
$routes->get('/barangctrl/databarang', 'BarangCtrl::databarang');
$routes->post('/barangctrl/simpan', 'BarangCtrl::simpan');
$routes->post('/barangctrl/updatebarang', 'BarangCtrl::updatebarang');
$routes->get('/barangctrl/editbarang/(:any)', 'BarangCtrl::editbarang/$1');

