<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Auth extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "login_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            //email
            "login_email" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Role
            "login_role" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Name
            "login_name" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            "user_createdAt datetime default current_timestamp",
            "user_updatedAt datetime default current_timestamp on update current_timestamp",
            //Foreign Key from user User_information Table
            "user_id_fk" => [
                "type" => "INT",
                "unsigned" => true,
                "null"       => true,  // If using SET NULL on delete
            ],

        ]);
        $this->forge->addPrimaryKey("login_id");
        $this->forge->addForeignKey("user_id_fk", "tbl_user_information", "user_id", "SET NULL", "CASCADE");
        $this->forge->createTable("tbl_authorization");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_authorization");
    }
}
