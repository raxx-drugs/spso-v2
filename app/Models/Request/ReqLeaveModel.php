<?php

namespace App\Models\Request;

use CodeIgniter\Model;

class ReqLeaveModel extends Model
{
    protected $table            = 'tbl_req_leaves';
    protected $primaryKey       = 'req_leave_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "req_leave_employee_name",
        "req_leave_type",
        "req_leave_leave_type_child",
        "req_leave_leave_reason",
        "req_leave_start_date",
        "req_leave_end_date",
        "req_leave_total_days",
        "req_leave_request_date",
        "req_leave_status",
        "req_leave_approval_date",
        "req_leave_approved_by",
        "req_leave_admin_remarks",

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
