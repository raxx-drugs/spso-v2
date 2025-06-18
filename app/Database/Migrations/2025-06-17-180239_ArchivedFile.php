<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ArchivedFile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "archived_id"=> [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
             //role
             "archived_role" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //email
            "archived_email" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Item Type
            "archived_item_type" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Deleted item data
            "archived_item_data" => [
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 255
            ],
            //Description
            "archived_description" => [
                "type" => "LONGTEXT",
                "null" => true,
            ],
            "archived_createdAt datetime default current_timestamp",
        ]);
        $this->forge->addPrimaryKey("archived_id");
        $this->forge->createTable("tbl_archived_files");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_archived_files");
    }
}