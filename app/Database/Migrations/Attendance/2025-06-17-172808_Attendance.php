<?php

namespace App\Database\Migrations\Attendance;

use CodeIgniter\Database\Migration;

class Attendance extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Primary Key
            'attendance_id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            // Status (e.g., Active, Archived, etc.)
            'attendance_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            // Total Days Present
            'attendance_total_days_present' => [
                'type'       => 'INT',
                'null'       => false,
                'default'    => 0,
            ],
            // Absences Without Official Leave
            'attendance_leave' => [
                'type'       => 'INT',
                'null'       => false,
                'default'    => 0,
            ],
            // Absences With Approved Leave
            'attendance_approved' => [
                'type'       => 'INT',
                'null'       => false,
                'default'    => 0,
            ],
            // Foreign Key to User Information
            'user_id_fk' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            // Created Timestamp
            'attendance_createdAt' => [
                'type'    => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        $this->forge->addPrimaryKey('attendance_id');
        $this->forge->addForeignKey('user_id_fk', 'tbl_user_information', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_attendance');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_attendance');
    }
}
