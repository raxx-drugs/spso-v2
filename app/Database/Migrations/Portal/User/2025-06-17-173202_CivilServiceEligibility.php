<?php

namespace App\Database\Migrations\Portal\User;

use CodeIgniter\Database\Migration;

class CivilServiceEligibility extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "user_civil_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            /*"CAREER SERVICE/ RA 1080
            (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/
            CSEE BARANGAY ELIGIBILITY / DRIVER'S LICENSE" */
            "user_career" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Rating
            "user_rating" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //DATE OF EXAMINATION / CONFERMENT
            "user_date_examination" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //PLACE OF EXAMINATION / CONFERMENT
            "user_place_examination" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Licence (if available) Image
            "user_license" => [
                "type" => "BLOB",
                "null" => true,
            ],
            //Licence Number
            "user_license_number" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Licence Date of Validity
            "user_license_validity" => [
                "type" => "DATE",
                "null" => true,

            ],
            // Foreign Key from user Family Table
            "user_id_fk" => [
                "type" => "INT",
                "unsigned" => true,
            ],
        ]);
        $this->forge->addPrimaryKey("user_civil_id");
        $this->forge->addForeignKey("user_id_fk", "tbl_user_information", "user_id", "CASCADE", "CASCADE");
        $this->forge->createTable("tbl_user_civil");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_user_civil");
    }
}

