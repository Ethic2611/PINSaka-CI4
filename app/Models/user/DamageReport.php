<?php
namespace App\Models\user;
use CodeIgniter\Model;

class DamageReport extends Model
{
    protected $table            = 'damage_reports';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['full_name', 'nip', 'department', 'phone', 'damage_description', 'photo', 'status'];
    protected $useTimestamps    = true;
}