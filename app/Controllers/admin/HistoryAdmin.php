<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoomBookingMA;
use App\Models\VehicleBookingMA;
use App\Models\DamageReportMA;

class HistoryAdmin extends BaseController
{
    public function index()
    {
        $roomModel    = new RoomBookingMA();
        $vehicleModel = new VehicleBookingMA();
        $damageModel  = new DamageReportMA();

        $allHistory = [];

        // 1. Ambil data Peminjaman Ruangan
        $rooms = $roomModel->orderBy('created_at', 'DESC')->findAll();
        foreach ($rooms as $r) {
            $allHistory[] = [
                'id'         => $r['id'],
                'source'     => 'room',
                'user'       => $r['full_name'] ?? 'N/A',
                'type'       => 'Peminjaman Ruangan',
                'item'       => $r['item'] ?? '-',
                'date'       => $r['start_date'] ?? date('Y-m-d', strtotime($r['created_at'])),
                'status'     => $r['status'] ?? 'Pending',
                'created_at' => $r['created_at']
            ];
        }

        // 2. Ambil data Peminjaman Kendaraan
        $vehicles = $vehicleModel->orderBy('created_at', 'DESC')->findAll();
        foreach ($vehicles as $v) {
            $allHistory[] = [
                'id'         => $v['id'],
                'source'     => 'vehicle',
                'user'       => $v['full_name'] ?? 'N/A',
                'type'       => 'Peminjaman Kendaraan',
                'item'       => $v['item'] ?? '-',
                'date'       => $v['start_date'] ?? date('Y-m-d', strtotime($v['created_at'])),
                'status'     => $v['status'] ?? 'Pending',
                'created_at' => $v['created_at']
            ];
        }

        // Urutkan data gabungan peminjaman berdasarkan waktu pembuatan terbaru
        usort($allHistory, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        // 3. Masukkan data ke array $data yang akan dikirim ke view
        $data['bookings']       = $allHistory;
        $data['damage_reports'] = $damageModel->orderBy('created_at', 'DESC')->findAll();

        // 4. Panggil View HANYA SATU KALI di baris paling akhir
        return view('admin/history', $data);
    }
}