<?php

namespace App\Database\Migrations\Portal\User;

use CodeIgniter\Database\Migration;

class EducationBackground extends Migration
{
     public function up()
    {
        $this->forge->addField([
            "user_education_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            //Elementary School Name
            "user_elem_school" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Period of Attendance (Elem)
            "user_elem_period" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Secondary School Name
            "user_secondary_school" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Period of Attendance (Secondary)
            "user_secondary_period" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Vocational Trade Course 
            "user_vocational_course" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Period of Attendance (Vocational)
            "user_vocational_period" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //College
            "user_college" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Course
            "user_college_course" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Period of Attendance (College)
            "user_college_period" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //"Highest Level/Units earned if not graduate"
            "user_highest_level_unit" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Graduates Studies
            "user_graduate_studies" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //"Scholarship / Academic Honors Received"
            "user_academic_honors" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            // Foreign Key from user Informatiaon Table
            "user_id_fk" => [
                "type" => "INT",
                "unsigned" => true,
            ],
        ]);
        //Primary key for this current table
        $this->forge->addPrimaryKey("user_education_id");
        //"user_id_fk" → The column in the current table that will act as a foreign key.
        //"user_information" → The name of the parent table (the table being referenced).
        //"user_id" → The primary key column of the user_information table being referenced.
        //"CASCADE" → ON DELETE CASCADE → If a user is deleted from user_information, all related records in the current table will also be deleted.
        //"CASCADE" → ON UPDATE CASCADE → If the user_id in user_information is updated, all related records in the current table will also be updated.
        $this->forge->addForeignKey("user_id_fk", "tbl_user_information", "user_id", "CASCADE", "CASCADE");
        //Table name
        $this->forge->createTable("tbl_user_education");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_user_education");
    }
}