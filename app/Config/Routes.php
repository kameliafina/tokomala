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
$routes->get('adminctrl/histori_view', 'AdminCtrl::histori_view');
$routes->get('adminctrl/histori_list', 'AdminCtrl::histori_list');
$routes->get('adminctrl/histori_dikirim', 'AdminCtrl::histori_dikirim');
$routes->get('adminctrl/histori_diterima', 'AdminCtrl::histori_diterima');
$routes->get('adminctrl/laporan', 'AdminCtrl::laporan');
$routes->get('adminctrl/laporan_dikemas', 'AdminCtrl::laporan_dikemas');
$routes->get('adminctrl/laporan_dikirim', 'AdminCtrl::laporan_dikirim');
$routes->get('adminctrl/print_laporan', 'AdminCtrl::print_laporan');
$routes->get('adminctrl/print_laporan2', 'AdminCtrl::print_laporan2');
$routes->put('/adminctrl/updateStatus/(:num)', 'AdminCtrl::updateStatus/$1');


$routes->get('pelangganctrl/index', 'PelangganCtrl::index');
$routes->get('pelangganctrl/databarang', 'PelangganCtrl::databarang');
$routes->get('/pelangganctrl/barangByKategori/(:num)', 'PelangganCtrl::barangByKategori/$1');
$routes->get('pelangganctrl/profile', 'PelangganCtrl::profile');
$routes->post('/pelangganctrl/tambahkeranjang', 'PelangganCtrl::tambahKeranjang');
$routes->get('/pelangganctrl/keranjang', 'PelangganCtrl::keranjang');
$routes->get('/pelangganctrl/pembayaran', 'PelangganCtrl::pembayaran');
$routes->get('/pelangganctrl/suksesPembayaran', 'PelangganCtrl::pembayaranSukses');
$routes->post('/pelangganctrl/prosespembayaran', 'PelangganCtrl::prosespembayaran');
$routes->get('/pelangganctrl/hapuskeranjang/(:num)', 'PelangganCtrl::hapusKeranjang/$1');
$routes->post('/pelangganctrl/ubahjumlah/(:segment)', 'PelangganCtrl::ubahjumlah/$1');
$routes->get('/pelangganctrl/lacak', 'PelangganCtrl::lacak');
$routes->get('/pelangganctrl/barang_dikemas', 'PelangganCtrl::barang_dikemas');
$routes->get('/pelangganctrl/detail_dikemas/(:num)', 'PelangganCtrl::detail_dikemas/$1');
$routes->get('/pelangganctrl/barang_dikirim', 'PelangganCtrl::barang_dikirim');
$routes->get('/pelangganctrl/detail_dikirim/(:num)', 'PelangganCtrl::detail_dikirim/$1');
$routes->get('/pelangganctrl/updateStatus/(:num)', 'PelangganCtrl::updateStatus/$1');


$routes->get('hash-passwords', 'SetupCtrl::hashPasswords');


$routes->get('/barangctrl/index', 'BarangCtrl::index');
$routes->get('/barangctrl/tambah', 'BarangCtrl::tambah');
$routes->get('/barangctrl/databarang', 'BarangCtrl::databarang');
$routes->post('/barangctrl/simpan', 'BarangCtrl::simpan');
$routes->post('/barangctrl/updatebarang', 'BarangCtrl::updatebarang');
$routes->get('/barangctrl/editbarang/(:any)', 'BarangCtrl::editbarang/$1');

