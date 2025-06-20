<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeletedFile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "deleted_id"=> [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
             //role
             "deleted_role" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //email
            "deleted_email" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Item Type
            "deleted_item_type" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Deleted item data
            "deleted_item_data" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Description
            "deleted_description" => [
                "type" => "LONGTEXT",
                "null" => true,
            ],
            "deleted_createdAt datetime default current_timestamp",
        ]);
        $this->forge->addPrimaryKey("deleted_id");
        $this->forge->createTable("tbl_deleted_files");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_deleted_files");
    }
}
