<?php
namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') return redirect()->to('/dashboard');
        return view('admin/index', ['bookings'=>session()->get('bookings') ?? []]);
    }

    public function approve($id) { return $this->status($id, 'Disetujui'); }
    public function reject($id) { return $this->status($id, 'Ditolak'); }

    private function status($id, $status)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') return redirect()->to('/login');
        $bookings = session()->get('bookings') ?? [];
        foreach ($bookings as &$b) if ((int)$b['id'] === (int)$id) $b['status'] = $status;
        session()->set('bookings', $bookings);
        return redirect()->to('/admin');
    }
}
