<?php

namespace App\Models\Portal\User;

use CodeIgniter\Model;

class FamilyModel extends Model
{
    protected $table            = 'tbl_user_family';
    protected $primaryKey       = 'user_family_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "user_spouses_fname",
        "user_spouses_mname",
        "user_spouses_lname",
        "user_father_fname",
        "user_father_mname",
        "user_father_lname",
        "user_father_suffix",
        "user_mother_fname",
        "user_mother_mname",
        "user_mother_lname",
        "user_id_fk",
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
