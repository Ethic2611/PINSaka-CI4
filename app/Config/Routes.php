<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama & Auth
$routes->addRedirect('/', 'auth/login');

// Autentikasi
$routes->get('login', 'AuthController::login');
$routes->post('login/process', 'AuthController::loginProcess');
$routes->get('register', 'AuthController::register');
$routes->post('register/process', 'AuthController::registerProcess');
$routes->get('logout', 'AuthController::logout');

// Route khusus ADMIN
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard-admin', 'Admin\Dashboard::index');
    $routes->get('history', 'Admin\HistoryAdmin::index');
    
    // Rute Peminjaman Ruangan Admin
    $routes->get('room-booking', 'Admin\RoomBooking::index');
    $routes->get('room-history', 'Admin\RoomHistory::index');
    $routes->get('approve/room/(:num)', 'Admin\RoomApproval::approve/$1');
    $routes->get('reject/room/(:num)', 'Admin\RoomApproval::reject/$1');
    $routes->get('booking', 'Admin\Booking::room');      // Menampilkan form
    $routes->post('booking/save', 'Admin\Booking::save'); // Menyimpan data

    // Rute Peminjaman Kendaraan
    $routes->get('vehicle-booking', 'Admin\VehicleBooking::index');
    $routes->get('approve/vehicle/(:num)', 'Admin\VehicleApproval::approve/$1');
    $routes->get('vehicle-history', 'Admin\VehicleApproval::history');
    $routes->get('booking', 'Admin\Booking::vehicle');      // Menampilkan form
    $routes->post('booking/save2', 'Admin\Booking::save2'); // Menyimpan data


    // Rute Pelaporan Kerusakan
    $routes->get('damage-report', 'Admin\DamageReport::index');
    $routes->post('damage-report/save', 'Admin\DamageReport::save'); 
    $routes->get('damage-reports', 'Admin\DamageApproval::index');
    $routes->get('approve/damage/(:num)', 'Admin\DamageApproval::approve/$1');
    $routes->get('damage-history', 'Admin\DamageApproval::history');
});

// Route khusus USER
$routes->group('user', ['filter' => 'authFilter'], function($routes) {
    // User Dashboard & Fitur Utama
    $routes->get('dashboard', 'User\DashboardController::index');
    $routes->get('booking/room', 'User\BookingController::room');
    $routes->get('booking/vehicle', 'User\BookingController::vehicle');
    $routes->post('booking/save', 'User\BookingController::save');

    // Riwayat
    $routes->get('history', 'User\History::index');
    $routes->get('history/pdf', 'User\History::pdf');
    $routes->get('history/getLatestData', 'User\History::getLatestData');

    // Peminjaman Ruangan (Pengajuan)
    $routes->get('pinjam-ruangan', 'User\PengajuanController::ruangan');
    $routes->post('pinjam-ruangan/store', 'User\PengajuanController::storeRuangan');

    // Peminjaman Kendaraan
    $routes->get('pinjam-kendaraan', 'User\PengajuanController::kendaraan');
    $routes->post('pinjam-kendaraan/store', 'User\PengajuanController::storeKendaraan');

    // Pelaporan Kerusakan
    $routes->get('lapor-kerusakan', 'User\PengajuanController::kerusakan');
    $routes->post('lapor-kerusakan/store', 'User\PengajuanController::storeKerusakan');
});