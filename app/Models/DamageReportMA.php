<?php
namespace App\Models;
use CodeIgniter\Model;

class DamageReportMA extends Model
{
    protected $table            = 'damage_reports';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['full_name', 'nip', 'department', 'phone', 'damage_description', 'photo', 'status'];
    protected $useTimestamps    = true;
}