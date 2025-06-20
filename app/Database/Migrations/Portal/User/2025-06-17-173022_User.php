<?php

namespace App\Database\Migrations\Portal\User;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            //user ID
            "user_id"=>[
                "type" => "INT",
                "auto_increment"=> true,
                "unsigned" => true
            ],
            //user first name
            "user_fname"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Middle Name
            "user_mname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            //Last Name
            "user_lname"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Suffix
            "user_suffix"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            //Birth Date
            "user_birth_date"=>[
                "type" => "DATE",
                "null" => false,
            ],
            //Place of Birth
            "user_birth_place"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Sex
            "user_sex"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Civil Status
            "user_civil_status"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Height
            "user_height"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            //Weight
            "user_weight"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            //Blood Type
            "user_blood_type"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            //Mobile Number
            "user_mobile_number"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Telephone Number 
            "user_telephone_number"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            //Lot No/Apartment No/House No
            "user_house_number"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Street
            "user_street"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Region
            "user_region"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Province
            "user_province"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Municipality
            "user_municipality"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Barangay
            "user_barangay"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //TIN
            "user_tin_number"=>[
                "type" => "INT",
                "null" => true,
                "constraint" => 50
            ],
            //Philhealth No
            "user_philhealth_number"=>[
                "type" => "INT",
                "null" => true,
                "constraint" => 50
            ],
            //SSS No
            "user_sss_number"=>[
                "type" => "INT",
                "null" => true,
                "constraint" => 50
            ],
            //Pag-Ibig ID No
            "user_pagibig_number"=>[
                "type" => "INT",
                "null" => true,
                "constraint" => 50
            ],
            //GSIS No
            "user_gsis_number"=>[
                "type" => "INT",
                "null" => true,
                "constraint" => 50
            ],
            //Citizenship
            "user_citizenship"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Profile Picture (binary)
            "user_image"=>[
                "type" => "LONGBLOB",
                "null" => true
            ],
            //Signature (binary)
            "user_signature"=>[
                "type" => "LONGBLOB",
                "null" => true
            ],
            //role
            "user_role"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //user email address
            "user_email"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //user password
            "user_password"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            "user_createdAt datetime default current_timestamp",
            "user_updatedAt datetime default current_timestamp on update current_timestamp"

        ]);
        $this->forge->addPrimaryKey("user_id");
        $this->forge->createTable("tbl_user_information");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_user_information");
    }
}
