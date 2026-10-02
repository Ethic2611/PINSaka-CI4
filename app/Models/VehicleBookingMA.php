<?php
namespace App\Models;
use CodeIgniter\Model;

class VehicleBookingMA extends Model
{
    protected $table            = 'vehicle_bookings';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['full_name', 'nip', 'department', 'phone', 'email', 'item', 'purpose', 'personnel_count', 'start_date', 'end_date', 'time_slot', 'status'];
    protected $useTimestamps    = true;
}