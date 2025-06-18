<?php

namespace App\Controllers\Request;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class ReqItEquipmentController extends BaseController
{
    use ActivityLoggerTrait;

    private function extractData(array $post): array
    {
        $fields = [
            'item_name'          => 'req_it_equip_item_name',
            'category'           => 'req_it_equip_category',
            'description'        => 'req_it_equip_description',
            'requested_quantity' => 'req_it_equip_requested_quantity',
            'approved_quantity'  => 'req_it_equip_approved_quantity',
            'request_date'       => 'req_it_equip_request_date',
            'requester_name'     => 'req_it_equip_requester_name',
            'status'             => 'req_it_equip_status',
            'approval_status'    => 'req_it_equip_approval_status',
            'approval_date'      => 'req_it_equip_approval_date',
            'approved_by'        => 'req_it_equip_approved_by',
            'admin_remarks'      => 'req_it_equip_admin_remarks',
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
        $post     = $this->request->getPost();
        $data     = $this->extractData($post);

        if ($this->reqItEquipmentObj->insert($data)) {
            $this->logActivity('create', 'IT Equipment Request', 'Successfully added a request.');
            return redirect()->back()->with('success', 'Request submitted successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to submit request.')
            ->with('errors', $this->reqItEquipmentObj->errors());
    }

    public function fetchAll()
    {
        $records = $this->reqItEquipmentObj->findAll();
        $data = [];
        $modalId = 'viewReqItEquipModal';
        $index = 1;

        foreach ($records as $row) {
            $id = $row['req_it_equip_id'];
            $data[] = [
                $index++,
                $row['req_it_equip_item_name'],
                $row['req_it_equip_category'],
                $row['req_it_equip_requested_quantity'],
                $row['req_it_equip_requester_name'],
                $row['req_it_equip_status'],
                view('components/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/req-it-equipment/{$id}"),
                    'viewModalId' => $modalId,
                    'delete'      => base_url("api/req-it-equipment/delete/{$id}"),
                    'archive'     => base_url("api/req-it-equipment/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $record = $this->reqItEquipmentObj->find($id);

        if ($record) {
            return $this->response->setJSON([
                'data'    => $record,
                'status'  => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Request not found.',
        ])->setStatusCode(404);
    }

    public function update($id)
    {
        if (!$this->reqItEquipmentObj->find($id)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Request not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getRawInput();
        $data = $this->extractData($post);

        if ($this->reqItEquipmentObj->update($id, $data)) {
            $this->logActivity('update', 'IT Equipment Request', 'Successfully updated a request.');
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Request updated successfully.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update request.',
            'errors'  => $this->reqItEquipmentObj->errors(),
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
        $record = $this->reqItEquipmentObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role'),
            "{$type}d_email"       => session('email'),
            "{$type}d_item_type"   => "request_it_equipment",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "The IT equipment request is {$type}d",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->reqItEquipmentObj->delete($id)) {
            $this->logActivity($type, 'IT Equipment Request', "Successfully {$type}d a request.");
            return redirect()->back()->with('success', "Request successfully {$type}d.");
        }

        return redirect()->back()
            ->with('error', "Failed to {$type} request.")
            ->with('errors', $this->reqItEquipmentObj->errors());
    }

    public function getStats()
    {
        $total    = $this->reqItEquipmentObj->countAll();
        $pending  = $this->reqItEquipmentObj->where('req_it_equip_status', 'Pending')->countAllResults();
        $approved = $this->reqItEquipmentObj->where('req_it_equip_status', 'Approved')->countAllResults();

        return $this->response->setJSON([
            'total'    => $total,
            'pending'  => $pending,
            'approved' => $approved,
        ]);
    }
}
