<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoomBookingMA;
use App\Models\ApprovedRoomBookingMA;

class RoomApproval extends BaseController
{
    public function approve($id)
    {
        $roomModel = new RoomBookingMA();
        $approvedModel = new ApprovedRoomBookingMA();

        // 1. Cari data pengajuan peminjaman
        $booking = $roomModel->find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // 2. Simpan/Salin data ke tabel approved_room_bookings
        // Menggunakan operator '??' untuk mencegah Undefined Array Key jika nama kolom berbeda
        $approvedData = [
            'booking_id'      => $booking['id'],
            'room_name'       => $booking['room_name'] ?? $booking['item'] ?? $booking['room'] ?? '-',
            'full_name'       => $booking['full_name'] ?? $booking['applicant_name'] ?? $booking['name'] ?? null,
            'purpose'         => $booking['purpose'] ?? '-',
            'start_date'      => $booking['start_date'] ?? date('Y-m-d'),
            'end_date'        => $booking['end_date'] ?? date('Y-m-d'),
            'start_time'      => $booking['start_time'] ?? $booking['time_slots'] ?? null,
            'end_time'        => $booking['end_time'] ?? null,
            'approval_status' => 'Disetujui',
            'approved_at'     => date('Y-m-d H:i:s')
        ];

        $approvedModel->insert($approvedData);

        // 3. Update status pada tabel utama room_bookings menjadi 'Disetujui'
        $roomModel->update($id, ['status' => 'Disetujui']);

        return redirect()->to(site_url('admin/room-history'))->with('success', 'Pengajuan berhasil disetujui dan disimpan ke tabel disetujui!');
    }

    public function reject($id)
    {
        $roomModel = new RoomBookingMA();

        $booking = $roomModel->find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Hapus data secara permanen saat ditolak
        $roomModel->delete($id);

        return redirect()->back()->with('success', 'Pengajuan berhasil ditolak dan dihapus dari sistem.');
    }
}