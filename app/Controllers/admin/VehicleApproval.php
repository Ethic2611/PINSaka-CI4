<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VehicleBookingMA;
use App\Models\ApprovedVehicleBookingMA;

class VehicleApproval extends BaseController
{
    // Halaman Kelola Pengajuan
    public function index()
    {
        $model = new VehicleBookingMA();
        $data['pending_bookings'] = $model->where('status', 'Pending')->orderBy('created_at', 'DESC')->findAll();
        return view('admin/vehicle-booking', $data);
    }

    // Setujui Pengajuan -> Simpan ke database approved_vehicle_bookings
    public function approve($id = null)
    {
        $bookingModel  = new VehicleBookingMA();
        $approvedModel = new ApprovedVehicleBookingMA();

        $booking = $bookingModel->find($id);
        if ($booking) {
            // Update status pengajuan utama
            $bookingModel->update($id, ['status' => 'Disetujui']);

            // Simpan ke database khusus yang disetujui
            $approvedModel->insert([
                'booking_id'      => $booking['id'],
                'full_name'       => $booking['full_name'],
                'vehicle_name'    => $booking['item'],
                'purpose'         => $booking['purpose'],
                'start_date'      => $booking['start_date'],
                'end_date'        => $booking['end_date'],
                'time_slots'      => $booking['time_slots'],
                'approval_status' => 'Disetujui',
                'approved_at'     => date('Y-m-d H:i:s')
            ]);

            return redirect()->to(site_url('admin/vehicle-booking'))->with('success', 'Pengajuan kendaraan berhasil disetujui.');
        }
        return redirect()->to(site_url('admin/vehicle-booking'))->with('error', 'Data tidak ditemukan.');
    }

    // Tampilkan Riwayat yang Disetujui
    public function history()
    {
        $approvedModel = new ApprovedVehicleBookingMA();
        $data['approved_vehicle_bookings'] = $approvedModel->orderBy('approved_at', 'DESC')->findAll();
        return view('admin/vehicle-history', $data);
    }
}