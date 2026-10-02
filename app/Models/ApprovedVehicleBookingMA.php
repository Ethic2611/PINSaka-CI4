<?php
namespace App\Models;
use CodeIgniter\Model;

class ApprovedVehicleBookingMA extends Model
{
    protected $table            = 'approved_vehicle_bookings';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['booking_id', 'full_name', 'vehicle_name', 'purpose', 'start_date', 'end_date', 'time_slots', 'approval_status', 'approved_at'];
    protected $useTimestamps    = false;
}