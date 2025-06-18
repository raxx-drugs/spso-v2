<?php

namespace App\Database\Migrations\Request;

use CodeIgniter\Database\Migration;

class ReqOfficeSupply extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Primary Key
            "req_supply_id" => [
                "type"           => "INT",
                "unsigned"       => true,
                "auto_increment" => true,
            ],

            // Supply Name
            "req_supply_name" => [
                "type"       => "VARCHAR",
                "constraint" => 255,
                "null"       => false,
            ],

            // Category
            "req_supply_category" => [
                "type"       => "VARCHAR",
                "constraint" => 100,
                "null"       => false,
            ],

            // Description
            "req_supply_description" => [
                "type" => "TEXT",
                "null" => true,
            ],

            // Requested Quantity
            "req_supply_requested_quantity" => [
                "type" => "INT",
                "null" => false,
            ],

            // Approved Quantity
            "req_supply_approved_quantity" => [
                "type" => "INT",
                "null" => true,
            ],

            // Request Date
            "req_supply_request_date" => [
                "type" => "DATE",
                "null" => false,
            ],

            // Requester Name
            "req_supply_requester_name" => [
                "type"       => "VARCHAR",
                "constraint" => 255,
                "null"       => false,
            ],

            // Status
            "req_supply_status" => [
                "type"       => "VARCHAR",
                "constraint" => 50,
                "null"       => true,
            ],

            // Approval Status
            "req_supply_approval_status" => [
                "type"       => "VARCHAR",
                "constraint" => 50,
                "null"       => true,
            ],

            // Approval Date
            "req_supply_approval_date" => [
                "type" => "DATE",
                "null" => true,
            ],

            // Approved By
            "req_supply_approved_by" => [
                "type"       => "VARCHAR",
                "constraint" => 255,
                "null"       => true,
            ],

            // Admin Remarks
            "req_supply_admin_remarks" => [
                "type" => "TEXT",
                "null" => true,
            ],
        ]);

        $this->forge->addPrimaryKey("req_supply_id");
        $this->forge->createTable("tbl_req_supply_requests");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_req_supply_requests");
    }
}