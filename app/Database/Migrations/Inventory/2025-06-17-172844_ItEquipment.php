<?php

namespace App\Database\Migrations\Inventory;

use CodeIgniter\Database\Migration;

class ItEquipment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Equipment ID
            "it_equipment_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            // Equipment Image (binary)
            "it_equipment_image" => [
                "type" => "LONGBLOB",
                "null" => true
            ],
            // Unit (e.g., model or type)
            "it_equipment_unit" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 100
            ],
            // Serial Number
            "it_equipment_serial_number" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 100
            ],
            // System Number
            "it_equipment_system_no" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 100
            ],
            // Requisition (reference or code)
            "it_equipment_requisition" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 100
            ],
            // Stock count or availability
            "it_equipment_stock" => [
                "type" => "INT",
                "null" => false,
                "unsigned" => true,
                "default" => 0
            ],
            // Status
            "it_equipment_status" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            // Unit value (cost or price)
            "it_equipment_unit_value" => [
                "type" => "DECIMAL",
                "constraint" => "15,2",
                "null" => true
            ],
            // Remarks
            "it_equipment_remarks" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            // Timestamps
            "it_equipment_createdAt datetime default current_timestamp",
            "it_equipment_updatedAt datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addPrimaryKey("it_equipment_id");
        $this->forge->createTable("tbl_it_equipment");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_it_equipment");
    }
}