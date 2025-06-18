<?php

namespace App\Database\Migrations\Portal\User;

use CodeIgniter\Database\Migration;

class Family extends Migration
{
    public function up()
    {
        $this->forge->addField([
            //user ID
            "user_family_id"=>[
                "type" => "INT",
                "auto_increment"=> true,
                "unsigned" => true
            ],
            // Spouses First Name
            "user_spouses_fname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],          
            // Spouses Middle Name
            "user_spouses_mname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            // Spouses Last Name
            "user_spouses_lname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],          
            //Father First Name
            "user_father_fname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],          
            //Father Middle Name
            "user_father_mname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],          
            //Father Last Name
            "user_father_lname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],          
            //Father Suffix
            "user_father_suffix"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],          
            //Mother First Name
            "user_mother_fname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],          
            //Mother Middle Name
            "user_mother_mname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],          
            //Mother Last Name
            "user_mother_lname"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            // Foreign Key from user Information
            "user_id_fk" => [
                "type" => "INT",
                "unsigned" => true,
            ],
        ]);
        $this->forge->addPrimaryKey("user_family_id");
        $this->forge->addForeignKey("user_id_fk", "tbl_user_information", "user_id", "CASCADE", "CASCADE");
        $this->forge->createTable("tbl_user_family");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_user_family");
    }
}
