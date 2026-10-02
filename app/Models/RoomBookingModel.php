<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomBookingModel extends Model
{
    protected $table            = 'room_bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'type',
        'full_name',
        'nip',
        'department',
        'phone',
        'email',
        'item',
        'purpose',
        'personnel_count',
        'start_date',
        'end_date',
        'time_slot',
        'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}