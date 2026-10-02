<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovedRoomBookingMA extends Model
{
    protected $table            = 'approved_room_bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'booking_id',
        'room_name',
        'full_name',
        'purpose',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'approval_status',
        'approved_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}