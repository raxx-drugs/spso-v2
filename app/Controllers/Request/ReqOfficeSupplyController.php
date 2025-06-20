<?php

namespace App\Controllers\Request;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class ReqOfficeSupplyController extends BaseController
{
    use ActivityLoggerTrait;

    private function extractData(array $post): array
    {
        $fields = [
            'name'               => 'req_supply_name',
            'category'           => 'req_supply_category',
            'description'        => 'req_supply_description',
            'requested_quantity' => 'req_supply_requested_quantity',
            'approved_quantity'  => 'req_supply_approved_quantity',
            'request_date'       => 'req_supply_request_date',
            'requester_name'     => 'req_supply_requester_name',
            'status'             => 'req_supply_status',
            'approval_status'    => 'req_supply_approval_status',
            'approval_date'      => 'req_supply_approval_date',
            'approved_by'        => 'req_supply_approved_by',
            'admin_remarks'      => 'req_supply_admin_remarks',
        ];

        $data = [];
        foreach ($fields as $inputKey => $dbKey) {
            if (isset($post[$inputKey]) && $post[$inputKey] !== '') {
                $data[$dbKey] = $post[$inputKey];
            }
        }

        return $data;
    }

    public function add()
    {
        $post = $this->request->getPost();
        $data = $this->extractData($post);

        if ($this->reqOfficeSupplyObj->insert($data)) {
            $this->logActivity('create', 'Office Supply Request', 'Successfully added a supply request.');
            return redirect()->back()->with('success', 'Office supply request submitted successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to submit office supply request.')
            ->with('errors', $this->reqOfficeSupplyObj->errors());
    }

    public function fetchAll()
    {
        $records = $this->reqOfficeSupplyObj->findAll();
        $data = [];
        $modalId = 'viewReqSupplyModal';
        $index = 1;

        foreach ($records as $row) {
            $id = $row['req_supply_id'];
            $data[] = [
                $index++,
                $row['req_supply_name'],
                $row['req_supply_category'],
                $row['req_supply_requested_quantity'],
                format_status($row['req_supply_status'] ?? 'N/A'),
                view('components/buttons/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/request/office-supply/{$id}"),
                    'viewModalId' => $modalId,
                    'delete'      => base_url("api/request/office-supply/delete/{$id}"),
                    'archive'     => base_url("api/request/office-supply/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $record = $this->reqOfficeSupplyObj->find($id);

        if ($record) {
            return $this->response->setJSON([
                'data'    => $record,
                'status'  => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Office supply request not found.',
        ])->setStatusCode(404);
    }

    public function update($id)
    {
        if (!$this->reqOfficeSupplyObj->find($id)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Office supply request not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getRawInput();
        $data = $this->extractData($post);

        if ($this->reqOfficeSupplyObj->update($id, $data)) {
            $this->logActivity('update', 'Office Supply Request', 'Successfully updated a supply request.');
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Supply request updated successfully.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update supply request.',
            'errors'  => $this->reqOfficeSupplyObj->errors(),
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
        $record = $this->reqOfficeSupplyObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Supply request not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role'),
            "{$type}d_email"       => session('email'),
            "{$type}d_item_type"   => "request_supply",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "The supply request is {$type}d",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->reqOfficeSupplyObj->delete($id)) {
            $this->logActivity($type, 'Office Supply Request', "Successfully {$type}d a supply request.");
            return redirect()->back()->with('success', "Supply request successfully {$type}d.");
        }

        return redirect()->back()
            ->with('error', "Failed to {$type} supply request.")
            ->with('errors', $this->reqOfficeSupplyObj->errors());
    }

    public function getStats()
    {
        $total    = $this->reqOfficeSupplyObj->countAll();
        $pending  = $this->reqOfficeSupplyObj->where('req_supply_status', 'Pending')->countAllResults();
        $approved = $this->reqOfficeSupplyObj->where('req_supply_status', 'Approved')->countAllResults();
        $denied   = $this->reqOfficeSupplyObj->where('req_supply_status', 'Denied')->countAllResults();

        return $this->response->setJSON([
            'total'    => $total,
            'pending'  => $pending,
            'approved' => $approved,
            'denied'   => $denied,
        ]);
    }
}
