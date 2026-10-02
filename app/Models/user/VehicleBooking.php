<?php
namespace App\Models\user;
use CodeIgniter\Model;

class VehicleBooking extends Model
{
    protected $table            = 'vehicle_bookings';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['full_name', 'nip', 'department', 'phone', 'email', 'item', 'purpose', 'personnel_count', 'start_date', 'end_date', 'time_slot', 'status'];
    protected $useTimestamps    = true;
}