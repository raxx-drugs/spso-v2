<?php

namespace App\Controllers\Request;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class ReqLeaveController extends BaseController
{
    use ActivityLoggerTrait;

    private function extractData(array $post): array
    {
        $fields = [
            'employee_name'       => 'req_leave_employee_name',
            'leave_type'          => 'req_leavle_leave_type',
            'leave_type_child'    => 'req_leave_leave_type_child',
            'leave_reason'        => 'req_leave_leave_reason',
            'start_date'          => 'req_leave_start_date',
            'end_date'            => 'req_leave_end_date',
            'total_days'          => 'req_leave_total_days',
            'request_date'        => 'req_leave_request_date',
            'status'              => 'req_leave_status',
            'approval_date'       => 'req_leave_approval_date',
            'approved_by'         => 'req_leave_approved_by',
            'admin_remarks'       => 'req_leave_admin_remarks',
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
        $data = $this->extractData($post);

        if ($this->reqLeaveObj->insert($data)) {
            $this->logActivity('create', 'Leave Request', 'Successfully added a leave request.');
            return redirect()->back()->with('success', 'Leave request submitted successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to submit leave request.')
            ->with('errors', $this->reqLeaveObj->errors());
    }

    public function fetchAll()
    {
        $records = $this->reqLeaveObj->findAll();
        $data = [];
        $modalId = 'viewReqLeaveModal';
        $index = 1;

        foreach ($records as $row) {
            $id = $row['req_leave_id'];
            $data[] = [
                $index++,
                $row['req_leave_employee_name'],
                $row['req_leavle_leave_type'],
                $row['req_leave_start_date'] . ' to ' . $row['req_leave_end_date'],
                format_status($row['req_leave_status'] ?? 'N/A'),
                view('components/buttons/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/request/leave/{$id}"),
                    'viewModalId' => $modalId,
                    'delete'      => base_url("api/request/leave/delete/{$id}"),
                    'archive'     => base_url("api/request/leave/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $record = $this->reqLeaveObj->find($id);

        if ($record) {
            return $this->response->setJSON([
                'data'    => $record,
                'status'  => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Leave request not found.',
        ])->setStatusCode(404);
    }

    public function update($id)
    {
        if (!$this->reqLeaveObj->find($id)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Leave request not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getRawInput();
        $data = $this->extractData($post);

        if ($this->reqLeaveObj->update($id, $data)) {
            $this->logActivity('update', 'Leave Request', 'Successfully updated a leave request.');
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Leave request updated successfully.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update leave request.',
            'errors'  => $this->reqLeaveObj->errors(),
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
        $record = $this->reqLeaveObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Leave request not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role'),
            "{$type}d_email"       => session('email'),
            "{$type}d_item_type"   => "request_leave",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "The leave request is {$type}d",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->reqLeaveObj->delete($id)) {
            $this->logActivity($type, 'Leave Request', "Successfully {$type}d a leave request.");
            return redirect()->back()->with('success', "Leave request successfully {$type}d.");
        }

        return redirect()->back()
            ->with('error', "Failed to {$type} leave request.")
            ->with('errors', $this->reqLeaveObj->errors());
    }

    public function getStats()
    {
        $total    = $this->reqLeaveObj->countAll();
        $pending  = $this->reqLeaveObj->where('req_leave_status', 'Pending')->countAllResults();
        $approved = $this->reqLeaveObj->where('req_leave_status', 'Approved')->countAllResults();
        $denied   = $this->reqLeaveObj->where('req_leave_status', 'Denied')->countAllResults();

        return $this->response->setJSON([
            'total'    => $total,
            'pending'  => $pending,
            'approved' => $approved,
            'denied'   => $denied,
        ]);
    }
}
