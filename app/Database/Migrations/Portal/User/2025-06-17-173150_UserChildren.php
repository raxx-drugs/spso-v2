<?php

namespace App\Database\Migrations\Portal\User;

use CodeIgniter\Database\Migration;

class UserChildren extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "user_child_id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            "user_children_full_name" => [
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            "user_children_birth_date" => [
                "type" => "DATE",
                "null" => true
            ],
            // Foreign Key from user Family Table
            "user_family_id_fk" => [
                "type" => "INT",
                "unsigned" => true,
            ],
        ]);
        $this->forge->addPrimaryKey("user_child_id");
        $this->forge->addForeignKey("user_family_id_fk", "tbl_user_family", "user_family_id", "CASCADE", "CASCADE");
        $this->forge->createTable("tbl_user_children");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_user_children");
    }
}