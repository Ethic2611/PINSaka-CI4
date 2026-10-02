<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoomBookingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'type'            => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'Ruangan'],
            'full_name'       => ['type' => 'VARCHAR', 'constraint' => 150],
            'nip'             => ['type' => 'VARCHAR', 'constraint' => 50],
            'department'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone'           => ['type' => 'VARCHAR', 'constraint' => 20],
            'email'           => ['type' => 'VARCHAR', 'constraint' => 100],
            'item'            => ['type' => 'VARCHAR', 'constraint' => 150],
            'purpose'         => ['type' => 'TEXT'],
            'personnel_count' => ['type' => 'INT', 'constraint' => 11],
            'start_date'      => ['type' => 'DATE'],
            'end_date'        => ['type' => 'DATE'],
            'time_slot'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'status'          => ['type' => 'ENUM', 'constraint' => ['Pending', 'Approved', 'Rejected'], 'default' => 'Pending'],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('room_bookings');
    }

    public function down()
    {
        $this->forge->dropTable('room_bookings');
    }
}