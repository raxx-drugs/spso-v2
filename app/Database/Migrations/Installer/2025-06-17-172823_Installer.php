<?php

namespace App\Database\Migrations\Installer;

use CodeIgniter\Database\Migration;

class Installer extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Installer ID
            "installer_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            // Installer image (binary)
            "installer_image" => [
                "type" => "LONGBLOB",
                "null" => true
            ],
            // Installer name
            "installer_name" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            // Installer description
            "installer_description" => [
                "type" => "TEXT",
                "null" => true
            ],
            // Installer attachment (binary)
            "installer_attachment" => [
                "type" => "LONGBLOB",
                "null" => true
            ],
            // Remarks
            "installer_remarks" => [
                "type" => "TEXT",
                "null" => true
            ],
            // Status
            "installer_status" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            // Timestamps
            "installer_createdAt datetime default current_timestamp",
            "installer_updatedAt datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addPrimaryKey("installer_id");
        $this->forge->createTable("tbl_installer");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_installer");
    }
}
