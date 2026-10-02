<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomBookingMA extends Model
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

    // Tambahkan method ini di bagian bawah
    public function getApprovedBookings()
    {
        return $this->where('status', 'Disetujui')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}