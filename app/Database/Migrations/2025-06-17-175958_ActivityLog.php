<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ActivityLog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Activity ID
            'activity_id' => [
                'type' => 'INT',
                'auto_increment' => true,
                'unsigned' => true,
            ],
            // Role of the user who performed the action
            'activity_role' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            // Name of the user who performed the action
            'activity_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            // Type of action (e.g., create, update, delete)
            'activity_action_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            // Type of target (e.g., announcement, download)
            'activity_target_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            // Description of the activity
            'activity_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // Timestamps
            'activity_createdAt datetime default current_timestamp',
        ]);

        $this->forge->addPrimaryKey('activity_id');
        $this->forge->createTable('tbl_activity_log');
    }
    public function down()
    {
        $this->forge->dropTable('tbl_activity_log');
    }
}
