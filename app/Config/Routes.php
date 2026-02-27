<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// Auth routes
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::process');
$routes->get('/logout', 'Auth::logout');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::processRegister');

// Dashboard route tunggal untuk semua role
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);


/* ===============================
   Admin & Petugas Routes
   =============================== */

// Buku (admin & petugas)
$routes->group('buku', ['filter' => 'auth:admin,petugas'], function ($routes) {
    $routes->get('/', 'Buku::index');
    $routes->get('tambah', 'Buku::create');
    $routes->post('save', 'Buku::save');
    $routes->get('edit/(:num)', 'Buku::edit/$1');
    $routes->post('update/(:num)', 'Buku::update/$1');
    $routes->get('delete/(:num)', 'Buku::delete/$1');
    $routes->get('cover/(:num)', 'Buku::show/$1');
});

// Anggota (admin & petugas)
$routes->group('anggota', ['filter' => 'auth:admin,petugas'], function ($routes) {
    $routes->get('/', 'Anggota::index');
    $routes->get('tambah', 'Anggota::create');
    $routes->post('save', 'Anggota::save');
    $routes->get('edit/(:num)', 'Anggota::edit/$1');
    $routes->post('update/(:num)', 'Anggota::update/$1');
    $routes->get('delete/(:num)', 'Anggota::delete/$1');
});

// Peminjaman & Pengembalian (admin & petugas)
$routes->group('peminjaman', ['filter' => 'auth:admin,petugas'], function ($routes) {
    $routes->get('/', 'Peminjaman::index');
    $routes->get('tambah', 'Peminjaman::create');
    $routes->post('save', 'Peminjaman::save');
    $routes->get('pengembalian/(:num)', 'Peminjaman::kembali/$1');
});


/* ===============================
   Siswa Routes
   =============================== */
$routes->group('siswa', ['filter' => 'auth:siswa'], function ($routes) {

    // Dashboard siswa
    $routes->get('dashboard', 'Dashboard::siswa');

    // Daftar buku & pinjam buku
    $routes->get('buku', 'BukuSiswa::index');                 // menampilkan daftar buku
    $routes->get('buku/pinjam/(:num)', 'BukuSiswa::pinjam/$1'); // pinjam buku

    // Riwayat peminjaman siswa
    $routes->get('peminjaman', 'PeminjamanSiswa::riwayat');
});
