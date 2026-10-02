<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama & Auth
$routes->addRedirect('/', 'login');
// Tambahkan baris ini di Routes.php
$routes->get('auth/login', 'AuthController::login');

// Maka redirect '/' ini bisa berjalan:
$routes->addRedirect('/', 'auth/login');

// Autentikasi
$routes->get('login', 'AuthController::login');
$routes->post('login/process', 'AuthController::loginProcess');
$routes->get('register', 'AuthController::register');
$routes->post('register/process', 'AuthController::registerProcess');
$routes->get('logout', 'AuthController::logout');

// Admin Panel
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard-admin', 'Admin\Dashboard::index');
    $routes->get('history', 'Admin\HistoryAdmin::index');
    
    // Rute Peminjaman Ruangan
    $routes->get('room-booking', 'Admin\RoomBooking::index');
    $routes->get('room-history', 'Admin\RoomHistory::index');
    $routes->get('approve/room/(:num)', 'Admin\RoomApproval::approve/$1');
    $routes->get('reject/room/(:num)', 'Admin\RoomApproval::reject/$1');

    // Rute Peminjaman Kendaraan
    $routes->get('vehicle-booking', 'Admin\VehicleBooking::index');
    $routes->get('approve/vehicle/(:num)', 'Admin\VehicleApproval::approve/$1');
    $routes->get('vehicle-history', 'Admin\VehicleApproval::history');

    // Rute Pelaporan Kerusakan (Damage Report)
    $routes->get('damage-report', 'Admin\DamageReport::index');
    // PERBAIKAN: Cukup 'damage-report/save' tanpa 'admin/' di depannya
    $routes->post('damage-report/save', 'Admin\DamageReport::save'); 
    $routes->get('damage-reports', 'Admin\DamageApproval::index');
    $routes->get('approve/damage/(:num)', 'Admin\DamageApproval::approve/$1');
    $routes->get('damage-history', 'Admin\DamageApproval::history');
});

// Route khusus USER (Peminjaman & Riwayat)
$routes->group('user', ['filter' => 'authFilter'], function($routes) {
    // User Dashboard & Fitur
$routes->get('dashboard', 'User\DashboardController::index');
$routes->get('booking/room', 'User\BookingController::room');
$routes->get('booking/vehicle', 'User\BookingController::vehicle');
$routes->get('booking/save', 'User\BookingController::save');
$routes->get('history', 'User\History::index');
$routes->get('history/pdf', 'User\History::pdf');

    // Route Peminjaman Ruangan
    $routes->get('pinjam-ruangan', 'User\PengajuanController::ruangan');
    $routes->post('pinjam-ruangan/store', 'User\PengajuanController::storeRuangan');
    $routes->post('user/room/store', 'User\PengajuanController::storeRuangan');

    // Route Peminjaman Kendaraan
    $routes->get('pinjam-kendaraan', 'User\PengajuanController::kendaraan');
    $routes->post('pinjam-kendaraan/store', 'User\PengajuanController::storeKendaraan');

    // Route Pelaporan Kerusakan
    $routes->get('lapor-kerusakan', 'User\PengajuanController::kerusakan');
    $routes->post('lapor-kerusakan/store', 'User\PengajuanController::storeKerusakan');

    // 1. Peminjaman Ruangan
    $routes->get('room', 'User\PengajuanController::ruangan');
    $routes->post('room/store', 'User\PengajuanController::storeRuangan');

    // 2. Peminjaman Kendaraan
    $routes->get('vehicle', 'User\PengajuanController::kendaraan');
    $routes->post('vehicle/store', 'User\PengajuanController::storeKendaraan');

    // 3. Pelaporan Kerusakan
    $routes->get('kerusakan', 'User\PengajuanController::kerusakan');
    $routes->post('kerusakan/store', 'User\PengajuanController::storeKerusakan');

    // 4. Riwayat Pengajuan
    $routes->get('history', 'User\HistoryController::index');
    $routes->get('history/getLatestData', 'User\History::getLatestData');

    // // Riwayat Pengajuan
    // $routes->get('history', 'User\HistoryController::index');
    // // Form Peminjaman Ruangan
    // $routes->get('User/room', 'User\BookingController::room');
    
    // // Simpan Pengajuan (Aksi Form)
    // $routes->post('User/save', 'User\BookingController::save');
    
    // // Riwayat Pengajuan User
    // $routes->get('User/history', 'User\BookingController::history');
});