<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Generate kode CAPTCHA acak (5 karakter)
        $captchaCode = substr(bin2hex(random_bytes(3)), 0, 5);
        
        // Simpan ke dalam Session (Format Kapital)
        session()->set('captcha', strtoupper($captchaCode));

        return view('auth/login');
    }

    public function loginProcess()
    {
        $username     = trim((string)$this->request->getPost('username'));
        $password     = (string)$this->request->getPost('password');
        $inputCaptcha = strtoupper(trim((string)$this->request->getPost('captcha')));
        
        $serverCaptcha = session()->get('captcha');

        // Reset/Generate ulang captcha baru agar captcha lama tidak bisa direuse
        $newCaptcha = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
        session()->set('captcha', $newCaptcha);

        // 1. Validasi CAPTCHA
        if (empty($inputCaptcha) || $inputCaptcha !== $serverCaptcha) {
            session()->setFlashdata('error', 'Kode CAPTCHA tidak sesuai!');
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();
        $user      = $userModel->where('username', $username)->first();

        // 2. Cek apakah user ditemukan
        if (!$user) {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->back()->withInput();
        }

        // 3. Verifikasi Password
        $verifyPassword = password_verify($password, $user['password']) || ($password === $user['password']);

        if (!$verifyPassword) {
            session()->setFlashdata('error', 'Password yang Anda masukkan salah!');
            return redirect()->back()->withInput();
        }

        // 4. RULE: Cek Verifikasi Akun / Status Aktif
        if (isset($user['status']) && $user['status'] != 1) {
            session()->setFlashdata('error', 'Akun Anda belum terverifikasi oleh administrator.');
            return redirect()->back()->withInput();
        }

        // 5. Simpan Data ke Session
        session()->set([
            'id'        => $user['id'],
            'name'      => $user['name'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true,
        ]);

        // 6. RULE: Redirect berdasarkan Role
        if ($user['role'] === 'admin') {
    return redirect()->to('/admin/dashboard-admin');
} else {
    return redirect()->to('/user/dashboard'); // atau '/dashboard' jika route di atas sudah diubah
}
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess()
    {
        $userModel = new UserModel();

        $name     = trim((string)$this->request->getPost('name'));
        $username = trim((string)$this->request->getPost('username'));
        $password = (string)$this->request->getPost('password');

        if ($name === '' || $username === '' || strlen($password) < 6) {
            session()->setFlashdata('error', 'Data tidak lengkap. Password minimal 6 karakter.');
            return redirect()->back()->withInput();
        }

        $existingUser = $userModel->where('username', $username)->first();
        if ($existingUser) {
            session()->setFlashdata('error', 'Username sudah digunakan!');
            return redirect()->back()->withInput();
        }

        $userModel->insert([
            'name'       => $name,
            'username'   => $username,
            'password'   => password_hash($password, PASSWORD_BCRYPT),
            'role'       => 'user',
            'status'     => 1,
        ]);

        session()->setFlashdata('success', 'Registrasi berhasil. Silakan login.');
        return redirect()->to('/login');
    }

    // Fitur Logout
    public function logout()
    {
        // Hapus semua data session
        session()->destroy();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->to('/login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}