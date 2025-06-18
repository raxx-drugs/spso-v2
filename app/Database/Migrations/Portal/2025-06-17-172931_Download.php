<?php

namespace App\Database\Migrations\Portal;

use CodeIgniter\Database\Migration;

class Download extends Migration
{
    public function up()
    {
         $this->forge->addField([
            //announcement ID
            "download_id"=>[
                "type" => "INT",
                "auto_increment"=> true,
                "unsigned" => true
            ],
            //Filename
            "download_file_name"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 255
            ],
            //Filetype
            "download_file_type"=>[
                "type" => "VARCHAR",
                "null" => true,
                "constraint" => 50
            ],
            //Attachment
            "download_file"=>[
                "type" => "LONGBLOB",
                "null" => true,
            ],
            //Remarks
            "download_remarks"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Permission Level
            "download_permission"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Status
            "download_status"=>[
                "type" => "VARCHAR",
                "null" => false,
                "constraint" => 50
            ],
            //Expiry Date
            "download_expiry_date"=>[
                "type" => "DATETIME",
                "null" => false,
            ],
            "download_createdAt datetime default current_timestamp",
            "download_updatedAt datetime default current_timestamp on update current_timestamp"

        ]);
        $this->forge->addPrimaryKey("download_id");
        $this->forge->createTable("tbl_download");
    }

    public function down()
    {
        $this->forge->dropTable("tbl_download");
    }
}
