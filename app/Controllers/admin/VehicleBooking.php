<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VehicleBookingMA;

class VehicleBooking extends BaseController
{
    public function index()
    {
        $vehicleModel = new VehicleBookingMA();
        
        $data['pending_bookings'] = $vehicleModel->where('status', 'Pending')
                                                 ->orderBy('created_at', 'DESC')
                                                 ->findAll();

        return view('admin/vehicle-booking', $data);
    }
}