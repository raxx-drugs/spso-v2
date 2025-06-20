<?php

namespace App\Models\Request;

use CodeIgniter\Model;

class ReqItSupportModel extends Model
{
    protected $table            = 'tbl_req_it_solutions';
    protected $primaryKey       = 'req_it_solution_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "req_it_solution_id",
        "req_it_solution_employee_name",
        "req_it_solution_description",
        "req_it_solution_request_date",
        "req_it_solution_status",
        "req_it_solution_action_by",
        "req_it_solution_action_date",
        "req_it_solution_action_remarks",

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
