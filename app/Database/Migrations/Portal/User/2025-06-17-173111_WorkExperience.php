<?php

namespace App\Database\Migrations\Portal\User;

use CodeIgniter\Database\Migration;

class WorkExperience extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "user_work_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            //work INCLUSIVE DATES from
            "user_inclusive_date_from" => [
                "type" => "DATE",
                "null" => true,
            ],
            //work INCLUSIVE DATES to
            "user_inclusive_date_to" => [
                "type" => "DATE",
                "null" => true,
            ],
            //DEPARTMENT / AGENCY / OFFICE / COMPANY
            "user_company" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //MONTHLY SALARY
            "user_monthly_salary" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //SALARY/ JOB/ PAY GRADE (if applicable)
            "user_salary" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //STATUS OF APPOINTMENT
            "user_status_appointment" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //GOV'T SERVICE 
            "user_gov_service" => [
                "type" => "BOOLEAN",
                "null" => true,
                "default" => true
            ],
            //Position
            "user_position" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            //Section
            "user_section" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            // Foreign Key from user Family Table
            "user_id_fk" => [
                "type" => "INT",
                "unsigned" => true,
            ],
        ]);
        $this->forge->addPrimaryKey("user_work_id");
        $this->forge->addForeignKey("user_id_fk", "tbl_user_information", "user_id", "CASCADE", "CASCADE");
        $this->forge->createTable("tbl_user_work");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_user_work");
    }
}
