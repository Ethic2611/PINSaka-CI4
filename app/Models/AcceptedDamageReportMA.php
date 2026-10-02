<?php
namespace App\Models;
use CodeIgniter\Model;

class AcceptedDamageReportMA extends Model
{
    protected $table            = 'accepted_damage_reports';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['report_id', 'full_name', 'damage_description', 'action_status', 'accepted_at'];
    protected $useTimestamps    = false;
}