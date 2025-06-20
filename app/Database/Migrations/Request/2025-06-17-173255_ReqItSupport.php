<?php

namespace App\Database\Migrations\Request;

use CodeIgniter\Database\Migration;

class ReqItSupport extends Migration
{
    public function up()
    {
        $this->forge->addField([
            // Primary Key
            "req_it_solution_id" => [
                "type"           => "INT",
                "unsigned"       => true,
                "auto_increment" => true,
            ],

            // Employee Name
            "req_it_solution_employee_name" => [
                "type"       => "VARCHAR",
                "constraint" => 255,
                "null"       => false,
            ],

            // Description
            "req_it_solution_description" => [
                "type" => "TEXT",
                "null" => false,
            ],

            // Request Date
            "req_it_solution_request_date" => [
                "type" => "DATE",
                "null" => false,
            ],

            // Status
            "req_it_solution_status" => [
                "type"       => "VARCHAR",
                "constraint" => 50,
                "null"       => true,
            ],

            // Action By
            "req_it_solution_action_by" => [
                "type"       => "VARCHAR",
                "constraint" => 255,
                "null"       => true,
            ],

            // Action Date
            "req_it_solution_action_date" => [
                "type" => "DATE",
                "null" => true,
            ],

            // Action Remarks
            "req_it_solution_action_remarks" => [
                "type" => "TEXT",
                "null" => true,
            ],
        ]);

        $this->forge->addPrimaryKey("req_it_solution_id");
        $this->forge->createTable("tbl_req_it_solutions");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_req_it_solutions");
    }
}
