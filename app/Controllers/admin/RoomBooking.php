<?php 

namespace App\Controllers\Admin; 

use App\Controllers\BaseController; 
use App\Models\RoomBookingMA; // Panggil Model di sini

class RoomBooking extends BaseController
{ 
    public function index() 
    { 
        $roomModel = new RoomBookingMA();

        // Mengambil data pengajuan status Pending
        $data['pending_bookings'] = $roomModel->where('status', 'Pending')
                                              ->orderBy('created_at', 'DESC')
                                              ->findAll();

        return view('admin/room-booking', $data); 
    } 
}