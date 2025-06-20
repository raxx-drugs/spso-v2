<?php

namespace App\Models\Request;

use CodeIgniter\Model;

class ReqItEquipmentModel extends Model
{
    protected $table            = 'tbl_req_it_equipment';
    protected $primaryKey       = 'req_it_equip_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "req_it_equip_item_name",
        "req_it_equip_category",
        "req_it_equip_description",
        "req_it_equip_requested_quantity",
        "req_it_equip_approved_quantity",
        "req_it_equip_request_date",
        "req_it_equip_requester_name",
        "req_it_equip_status",
        "req_it_equip_approval_status",
        "req_it_equip_approval_date",
        "req_it_equip_approved_by",
        "req_it_equip_admin_remarks",
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
