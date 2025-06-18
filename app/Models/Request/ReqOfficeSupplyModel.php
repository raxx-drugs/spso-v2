<?php

namespace App\Models\Request;

use CodeIgniter\Model;

class ReqOfficeSupplyModel extends Model
{
    protected $table            = 'reqofficesupplies';
    protected $primaryKey       = 'req_supply_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "req_supply_name",
        "req_supply_category",
        "req_supply_description",
        "req_supply_requested_quantity",
        "req_supply_approved_quantity",
        "req_supply_request_date",
        "req_supply_requester_name",
        "req_supply_status",
        "req_supply_approval_status",
        "req_supply_approval_date",
        "req_supply_approved_by",
        "req_supply_admin_remarks",

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
