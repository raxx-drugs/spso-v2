<?php

namespace App\Controllers\Request;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class ReqItSupportController extends BaseController
{
    use ActivityLoggerTrait;

    private function extractData(array $post): array
    {
        $fields = [
            'solution_id'         => 'req_it_solution_id',
            'employee_name'       => 'req_it_solution_employee_name',
            'description'         => 'req_it_solution_description',
            'request_date'        => 'req_it_solution_request_date',
            'status'              => 'req_it_solution_status',
            'action_by'           => 'req_it_solution_action_by',
            'action_date'         => 'req_it_solution_action_date',
            'action_remarks'      => 'req_it_solution_action_remarks',
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

        if ($this->reqItSupportObj->insert($data)) {
            $this->logActivity('create', 'IT Support Request', 'Successfully added a support request.');
            return redirect()->back()->with('success', 'Support request submitted successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to submit support request.')
            ->with('errors', $this->reqItSupportObj->errors());
    }

    public function fetchAll()
    {
        $records = $this->reqItSupportObj->findAll();
        $data = [];
        $modalId = 'viewReqItSupportModal';
        $index = 1;

        foreach ($records as $row) {
            $id = $row['req_it_support_id'];
            $data[] = [
                $index++,
                $row['req_it_solution_employee_name'],
                $row['req_it_solution_description'],
                $row['req_it_solution_request_date'],
                $row['req_it_solution_status'],
                view('components/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/req-it-support/{$id}"),
                    'viewModalId' => $modalId,
                    'delete'      => base_url("api/req-it-support/delete/{$id}"),
                    'archive'     => base_url("api/req-it-support/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $record = $this->reqItSupportObj->find($id);

        if ($record) {
            return $this->response->setJSON([
                'data'    => $record,
                'status'  => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Support request not found.',
        ])->setStatusCode(404);
    }

    public function update($id)
    {
        if (!$this->reqItSupportObj->find($id)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Support request not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getRawInput();
        $data = $this->extractData($post);

        if ($this->reqItSupportObj->update($id, $data)) {
            $this->logActivity('update', 'IT Support Request', 'Successfully updated a support request.');
            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Support request updated successfully.',
            ]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Failed to update support request.',
            'errors'  => $this->reqItSupportObj->errors(),
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
        $record = $this->reqItSupportObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Support request not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role'),
            "{$type}d_email"       => session('email'),
            "{$type}d_item_type"   => "request_it_support",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "The IT support request is {$type}d",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->reqItSupportObj->delete($id)) {
            $this->logActivity($type, 'IT Support Request', "Successfully {$type}d a support request.");
            return redirect()->back()->with('success', "Support request successfully {$type}d.");
        }

        return redirect()->back()
            ->with('error', "Failed to {$type} support request.")
            ->with('errors', $this->reqItSupportObj->errors());
    }

    public function getStats()
    {
        $total    = $this->reqItSupportObj->countAll();
        $pending  = $this->reqItSupportObj->where('req_it_solution_status', 'Pending')->countAllResults();
        $resolved = $this->reqItSupportObj->where('req_it_solution_status', 'Resolved')->countAllResults();

        return $this->response->setJSON([
            'total'    => $total,
            'pending'  => $pending,
            'resolved' => $resolved,
        ]);
    }
}
