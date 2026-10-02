<?php

namespace App\Controllers;

use App\Models\RoomBookingModel; 

class History extends BaseController
{
    public function index()
    {
        $model = new RoomBookingModel();

        // Ambil data dari database
        $data['room_bookings'] = $model->orderBy('id', 'DESC')->findAll();

        return view('history/index', $data);
    }
}