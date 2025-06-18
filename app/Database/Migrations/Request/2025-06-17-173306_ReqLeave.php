<?php

namespace App\Database\Migrations\Request;

use CodeIgniter\Database\Migration;

class ReqLeave extends Migration
{
     public function up()
    {
        $this->forge->addField([
            // Primary Key
            "req_leave_id" => [
                "type"           => "INT",
                "unsigned"       => true,
                "auto_increment" => true,
            ],

            // Employee Name
            "req_leave_employee_name" => [
                "type"       => "VARCHAR",
                "constraint" => 255,
                "null"       => false,
            ],

            // Leave Type
            "req_leavle_leave_type" => [
                "type"       => "VARCHAR",
                "constraint" => 100,
                "null"       => false,
            ],

            // Leave Type Child
            "req_leave_leave_type_child" => [
                "type"       => "VARCHAR",
                "constraint" => 100,
                "null"       => true,
            ],

            // Leave Reason
            "req_leave_leave_reason" => [
                "type" => "TEXT",
                "null" => true,
            ],

            // Start Date
            "req_leave_start_date" => [
                "type" => "DATE",
                "null" => false,
            ],

            // End Date
            "req_leave_end_date" => [
                "type" => "DATE",
                "null" => false,
            ],

            // Total Days
            "req_leave_total_days" => [
                "type" => "INT",
                "null" => false,
            ],

            // Request Date
            "req_leave_request_date" => [
                "type" => "DATE",
                "null" => false,
            ],

            // Status
            "req_leave_status" => [
                "type"       => "VARCHAR",
                "constraint" => 50,
                "null"       => true,
            ],

            // Approval Date
            "req_leave_approval_date" => [
                "type" => "DATE",
                "null" => true,
            ],

            // Approved By
            "req_leave_approved_by" => [
                "type"       => "VARCHAR",
                "constraint" => 255,
                "null"       => true,
            ],

            // Admin Remarks
            "req_leave_admin_remarks" => [
                "type" => "TEXT",
                "null" => true,
            ],
        ]);

        $this->forge->addPrimaryKey("req_leave_id");
        $this->forge->createTable("tbl_req_leaves");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_req_leaves");
    }
}
