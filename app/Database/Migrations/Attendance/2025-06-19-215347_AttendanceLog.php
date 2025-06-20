<?php

namespace App\Database\Migrations\Attendance;

use CodeIgniter\Database\Migration;

class AttendanceLog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Primary Key
            'attendance_logs_id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            // Foreign Key to tbl_attendance
            'attendance_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            // Date of Attendance
            'attendance_createdAt' => [
                'type'    => 'DATE',
                'null'    => false,
            ],
            // Time In
            'attendance_createdTime' => [
                'type'    => 'TIME',
                'null'    => false,
            ],
            // Shift Type (e.g., Morning, Evening, etc.)
            'attendance_shift' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            // Time Out
            'attendance_updatedAt' => [
                'type'    => 'TIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addPrimaryKey('attendance_logs_id');
        $this->forge->addForeignKey('attendance_id', 'tbl_attendance', 'attendance_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_attendance_logs');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_attendance_logs');
    }
}

