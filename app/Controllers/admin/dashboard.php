<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Cek sesi login & role admin
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Akses ditolak!');
            return redirect()->to('/login');
        }

        // Mengarahkan ke view: app/Views/admin/dashboard-admin.php
        return view('admin/dashboard-admin');
    }
}