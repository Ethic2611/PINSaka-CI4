<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\RoomBookingMA; // Menggunakan model yang sama dengan Admin

class History extends BaseController
{
    public function index()
    {
        $bookingModel = new RoomBookingMA();

        // Ambil data peminjaman yang berstatus 'Disetujui'
        $data['approved_bookings'] = $bookingModel->where('status', 'Disetujui')
                                                 ->orderBy('created_at', 'DESC')
                                                 ->findAll();

        return view('user/history', $data);
    }

    // Method untuk AJAX auto-refresh (digunakan oleh JavaScript di View)
    public function getLatestData()
    {
        $bookingModel = new RoomBookingMA();

        $data = $bookingModel->where('status', 'Disetujui')
                             ->orderBy('created_at', 'DESC')
                             ->findAll();

        return $this->response->setJSON($data);
    }
}