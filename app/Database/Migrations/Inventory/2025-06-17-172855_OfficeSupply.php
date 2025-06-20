<?php

namespace App\Database\Migrations\Inventory;

use CodeIgniter\Database\Migration;

class OfficeSupply extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Supply ID
            "office_supply_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            // Image (binary)
            "office_supply_image" => [
                "type" => "LONGBLOB",
                "null" => true
            ],
            // Name
            "office_supply_name" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            // Code
            "office_supply_code" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 100
            ],
            // Category
            "office_supply_category" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 100
            ],
            // Stocks
            "office_supply_stocks" => [
                "type" => "INT",
                "unsigned" => true,
                "null" => false,
                "default" => 0
            ],
            // Status
            "office_supply_status" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            // Description
            "office_supply_description" => [
                "type" => "TEXT",
                "null" => true
            ],
            // Timestamps
            "office_supply_createdAt datetime default current_timestamp",
            "office_supply_updatedAt datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addPrimaryKey("office_supply_id");
        $this->forge->createTable("tbl_office_supply");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_office_supply");
    }
}