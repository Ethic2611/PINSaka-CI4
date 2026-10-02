<?php
namespace App\Controllers\User;
use App\Controllers\BaseController;
class DashboardController extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) return redirect()->to('/login');
        return view('user/dashboard', [
            'name' => session()->get('name') ?? 'Pengguna',
            'role' => session()->get('role') ?? 'user'
        ]);
    }
}
