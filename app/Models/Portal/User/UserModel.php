<?php

namespace App\Models\Portal\User;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'tbl_user_information';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "user_fname",
        "user_mname",
        "user_lname",
        "user_suffix",
        "user_birth_date",
        "user_birth_place",
        "user_sex",
        "user_civil_status",
        "user_height",
        "user_weight",
        "user_blood_type",
        "user_mobile_number",
        "user_telephone_number",
        "user_house_number",
        "user_street",
        "user_region",
        "user_province",
        "user_municipality",
        "user_barangay",
        "user_tin_number",
        "user_philhealth_number",
        "user_sss_number",
        "user_pagibig_number",
        "user_gsis_number",
        "user_citizenship",
        "user_image",
        "user_signature",
        "user_role",
        "user_email",
        "user_password",
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
