<?php

namespace App\Models\Portal\User;

use CodeIgniter\Model;

class EducationBackgroundModel extends Model
{
    protected $table            = 'tbl_user_education';
    protected $primaryKey       = 'user_education_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "user_elem_school",
        "user_elem_period",
        "user_secondary_school",
        "user_secondary_period",
        "user_vocational_course",
        "user_vocational_period",
        "user_college",
        "user_college_course",
        "user_college_period",
        "user_highest_level_unit",
        "user_graduate_studies",
        "user_academic_honors",
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
