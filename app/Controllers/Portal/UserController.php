<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class UserController extends BaseController
{
    use ActivityLoggerTrait;

    private function extractData(array $post): array
    {
        $fields = [
            "fname"             => "user_fname",
            "mname"             => "user_mname",
            "lname"             => "user_lname",
            "suffix"            => "user_suffix",
            "birth_date"        => "user_birth_date",
            "birth_place"       => "user_birth_place",
            "sex"               => "user_sex",
            "civil_status"      => "user_civil_status",
            "height"            => "user_height",
            "weight"            => "user_weight",
            "blood_type"        => "user_blood_type",
            "mobile_number"     => "user_mobile_number",
            "telephone_number"  => "user_telephone_number",
            "house_number"      => "user_house_number",
            "street"            => "user_street",
            "region"            => "user_region",
            "province"          => "user_province",
            "municipality"      => "user_municipality",
            "barangay"          => "user_barangay",
            "tin_number"        => "user_tin_number",
            "philhealth_number" => "user_philhealth_number",
            "sss_number"        => "user_sss_number",
            "pagibig_number"    => "user_pagibig_number",
            "gsis_number"       => "user_gsis_number",
            "citizenship"       => "user_citizenship",
            "role"              => "user_role",
            "email"             => "user_email",
            "password"          => "user_password",
        ];

        $data = [];

        foreach ($fields as $inputKey => $dbKey) {
            if (!array_key_exists($inputKey, $post)) {
                continue;
            }

            $value = $post[$inputKey];
            if ($value === null || (is_string($value) && trim($value) === '')) {
                continue;
            }

            $data[$dbKey] = $value;
        }

        return $data;
    }

    public function add()
    {
        $post = $this->request->getPost();

        // Handle image and signature upload
        $image     = $this->request->getFile('image');
        $signature = $this->request->getFile('signature');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $post['image'] = file_get_contents($image->getTempName());
        }

        if ($signature && $signature->isValid() && !$signature->hasMoved()) {
            $post['signature'] = file_get_contents($signature->getTempName());
        }

        $userData = $this->extractData($post);
        $userData['user_image']     = $post['image']     ?? null;
        $userData['user_signature'] = $post['signature'] ?? null;

        if ($this->userModelObj->insert($userData)) {
            $this->logActivity('create', 'User', 'Successfully added a user.');
            return redirect()->back()->with('success', 'User added successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to add user.')
            ->with('errors', $this->userModelObj->errors());
    }

    public function fetchAll()
    {
        $userData = $this->userModelObj->findAll();
        $data = [];
        $viewModalId = 'viewUserModal';
        $index = 1;

        foreach ($userData as $row) {
            $id = $row['user_id'];
            $data[] = [
                $index++,
                $id,
                $row['user_fname'] . ' ' . $row['user_lname'],
                $row['user_email'],
                $row['user_role'],
                view('components/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/user/{$id}"),
                    'viewModalId' => $viewModalId,
                    'delete'      => base_url("api/user/delete/{$id}"),
                    'archive'     => base_url("api/user/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $data = $this->userModelObj->find($id);

        if ($data) {
            return $this->response->setJSON([
                'data'    => $data,
                'status'  => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'User not found.',
        ])->setStatusCode(404);
    }

    public function update($id)
    {
        if (!$this->userModelObj->find($id)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'User not found.',
            ])->setStatusCode(404);
        }

        $post      = $this->request->getRawInput();
        $userData  = $this->extractData($post);

        if ($this->userModelObj->update($id, $userData)) {
            $this->logActivity('update', 'User', 'Successfully updated a user.');
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'User updated successfully.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update user.',
            'errors'  => $this->userModelObj->errors()
        ])->setStatusCode(400);
    }

    public function archive($id)
    {
        return $this->handleRemoveOrArchive($id, 'archive');
    }

    public function delete($id)
    {
        return $this->handleRemoveOrArchive($id, 'delete');
    }

    private function handleRemoveOrArchive($id, $type = 'archive')
    {
        $record = $this->userModelObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role'),
            "{$type}d_email"       => session('email'),
            "{$type}d_item_type"   => "user",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "The user is {$type}d",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->userModelObj->delete($id)) {
            $this->logActivity($type, 'User', "Successfully {$type}d a user.");
            return redirect()->back()->with('success', "User successfully {$type}d!");
        }

        return redirect()->back()
            ->with('error', "Failed to {$type} user.")
            ->with('errors', $this->userModelObj->errors());
    }

    public function getStats()
    {
        $total    = $this->userModelObj->countAll();
        $active   = $this->userModelObj->where('user_role IS NOT NULL')->countAllResults(); // customize as needed
        $archived = $this->userModelObj->where('user_role', 'Archived')->countAllResults(); // example

        return $this->response->setJSON([
            'total'    => $total,
            'active'   => $active,
            'archived' => $archived,
        ]);
    }

    public function viewImage($id, $type = 'image')
    {
        $user = $this->userModelObj->find($id);

        if (!$user) {
            return $this->response->setStatusCode(404)->setBody('User not found.');
        }

        $binary = $type === 'signature' ? $user['user_signature'] : $user['user_image'];

        if (!$binary) {
            return $this->response->setStatusCode(404)->setBody('Image not found.');
        }

        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setHeader('Content-Disposition', 'inline')
            ->setBody($binary);
    }
}
