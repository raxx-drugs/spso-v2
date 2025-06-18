<?php

namespace App\Database\Migrations\Request;

use CodeIgniter\Database\Migration;

class ReqItEquipment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "req_it_equip_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            "req_it_equip_item_name" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => false,
            ],
            "req_it_equip_category" => [
                "type" => "VARCHAR",
                "constraint" => 100,
                "null" => false,
            ],
            "req_it_equip_description" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "req_it_equip_requested_quantity" => [
                "type" => "INT",
                "unsigned" => true,
                "null" => false,
            ],
            "req_it_equip_approved_quantity" => [
                "type" => "INT",
                "unsigned" => true,
                "null" => true,
            ],
            "req_it_equip_request_date" => [
                "type" => "DATE",
                "null" => false,
            ],
            "req_it_equip_requester_name" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => false,
            ],
            "req_it_equip_status" => [
                "type" => "VARCHAR",
                "constraint" => 50,
                "null" => false,
                "default" => 'pending',
            ],
            "req_it_equip_approval_status" => [
                "type" => "VARCHAR",
                "constraint" => 50,
                "null" => true,
            ],
            "req_it_equip_approval_date" => [
                "type" => "DATE",
                "null" => true,
            ],
            "req_it_equip_approved_by" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "req_it_equip_admin_remarks" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "req_it_equip_createdAt datetime default current_timestamp",
            "req_it_equip_updatedAt datetime default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addPrimaryKey("req_it_equip_id");
        $this->forge->createTable("tbl_req_it_equipment");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_req_it_equipment");
    }
}
