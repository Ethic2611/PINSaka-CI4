<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoomBookingMA;
use App\Models\VehicleBookingMA;
use App\Models\AcceptedDamageReportMA;

class RoomHistory extends BaseController
{
    public function index()
    {
        $roomModel     = new RoomBookingMA();
        $vehicleModel  = new VehicleBookingMA();
        $acceptedModel = new AcceptedDamageReportMA();

        $allBookings = [];

        // 1. Ambil SEMUA data ruangan (tanpa filter status apapun)
        $rooms = $roomModel->findAll();

        foreach ($rooms as $r) {
            $row = (array) $r;
            $allBookings[] = [
                'id'              => $row['id'] ?? null,
                'full_name'       => $row['full_name'] ?? $row['name'] ?? $row['nama'] ?? $row['user_id'] ?? 'N/A',
                'room_name'       => $row['room_name'] ?? $row['item'] ?? $row['ruangan'] ?? 'Ruangan',
                'purpose'         => $row['purpose'] ?? $row['keperluan'] ?? '-',
                'start_date'      => $row['start_date'] ?? $row['tanggal_mulai'] ?? (isset($row['created_at']) ? date('Y-m-d', strtotime($row['created_at'])) : '-'),
                'end_date'        => $row['end_date'] ?? $row['tanggal_selesai'] ?? '-',
                'start_time'      => $row['start_time'] ?? $row['time_slots'] ?? $row['jam_mulai'] ?? '-',
                'end_time'        => $row['end_time'] ?? $row['jam_selesai'] ?? '-',
                'approval_status' => $row['status'] ?? $row['approval_status'] ?? 'Pending',
                'type'            => 'Ruangan'
            ];
        }

        // 2. Ambil SEMUA data kendaraan
        $vehicles = $vehicleModel->findAll();

        foreach ($vehicles as $v) {
            $row = (array) $v;
            $allBookings[] = [
                'id'              => $row['id'] ?? null,
                'full_name'       => $row['full_name'] ?? $row['name'] ?? $row['nama'] ?? $row['user_id'] ?? 'N/A',
                'room_name'       => $row['vehicle_name'] ?? $row['item'] ?? $row['kendaraan'] ?? 'Kendaraan',
                'purpose'         => $row['purpose'] ?? $row['keperluan'] ?? '-',
                'start_date'      => $row['start_date'] ?? $row['tanggal_mulai'] ?? (isset($row['created_at']) ? date('Y-m-d', strtotime($row['created_at'])) : '-'),
                'end_date'        => $row['end_date'] ?? $row['tanggal_selesai'] ?? '-',
                'start_time'      => $row['start_time'] ?? $row['time_slots'] ?? $row['jam_mulai'] ?? '-',
                'end_time'        => $row['end_time'] ?? $row['jam_selesai'] ?? '-',
                'approval_status' => $row['status'] ?? $row['approval_status'] ?? 'Pending',
                'type'            => 'Kendaraan'
            ];
        }

        // 3. Ambil data Laporan Kerusakan
        $acceptedDamageReports = $acceptedModel->findAll();

        // 4. Kirim data ke View
        $data['approved_bookings']       = $allBookings; // Sekarang berisi SEMUA data pengajuan
        $data['accepted_damage_reports'] = $acceptedDamageReports;

        return view('admin/room-history', $data);
    }

    // Method API tambahan khusus untuk Auto-Refresh / Realtime Update (AJAX)
    public function getLatestData()
    {
        $roomModel    = new RoomBookingMA();
        $vehicleModel = new VehicleBookingMA();

        $allBookings = [];

        foreach ($roomModel->findAll() as $r) {
            $row = (array) $r;
            $allBookings[] = [
                'full_name'       => $row['full_name'] ?? $row['name'] ?? $row['nama'] ?? 'N/A',
                'room_name'       => $row['room_name'] ?? $row['item'] ?? 'Ruangan',
                'purpose'         => $row['purpose'] ?? $row['keperluan'] ?? '-',
                'start_date'      => $row['start_date'] ?? $row['tanggal_mulai'] ?? '-',
                'start_time'      => $row['start_time'] ?? $row['time_slots'] ?? '-',
                'approval_status' => $row['status'] ?? $row['approval_status'] ?? 'Pending',
            ];
        }

        foreach ($vehicleModel->findAll() as $v) {
            $row = (array) $v;
            $allBookings[] = [
                'full_name'       => $row['full_name'] ?? $row['name'] ?? $row['nama'] ?? 'N/A',
                'room_name'       => $row['vehicle_name'] ?? $row['item'] ?? 'Kendaraan',
                'purpose'         => $row['purpose'] ?? $row['keperluan'] ?? '-',
                'start_date'      => $row['start_date'] ?? $row['tanggal_mulai'] ?? '-',
                'start_time'      => $row['start_time'] ?? $row['time_slots'] ?? '-',
                'approval_status' => $row['status'] ?? $row['approval_status'] ?? 'Pending',
            ];
        }

        return $this->response->setJSON($allBookings);
    }
}