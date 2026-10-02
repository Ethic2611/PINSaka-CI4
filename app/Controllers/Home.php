<?php

namespace App\Controllers;

class Home extends BaseController
{
    // Di app/Controllers/Home.php
public function index()
{
    if (session()->get('logged_in')) {
        if (session()->get('role') === 'admin') {
            return redirect()->to('/admin/dashboard-admin');
        }
        return redirect()->to('/user/dashboard');
    }

    return redirect()->to('/login');
}
}
