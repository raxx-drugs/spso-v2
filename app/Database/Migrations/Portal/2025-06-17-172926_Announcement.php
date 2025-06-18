<?php

namespace App\Database\Migrations\Portal;

use CodeIgniter\Database\Migration;

class Announcement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Announcement ID
            "announcement_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            // Title
            "announcement_title" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            // Description
            "announcement_description" => [
                "type" => "TEXT",
                "null" => true
            ],
            // Category
            "announcement_category" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 100
            ],
            // Attachment (binary)
            "announcement_attachment" => [
                "type" => "LONGBLOB",
                "null" => true
            ],
            // Status
            "announcement_status" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            // Expiry Date
            "announcement_expiry_date" => [
                "type" => "DATETIME",
                "null" => false
            ],
            // Timestamps
            "announcement_createdAt datetime default current_timestamp",
            "announcement_updatedAt datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addPrimaryKey("announcement_id");
        $this->forge->createTable("tbl_announcement");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_announcement");
    }
}