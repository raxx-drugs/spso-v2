<?php

namespace App\Controllers\Installer;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class InstallerController extends BaseController
{
    use ActivityLoggerTrait;

    /**
     * Extracts installer data from the request post.
     */
    private function extractData(array $post): array
    {
        $fields = [
            'image'        => 'installer_image',
            'name'         => 'installer_name',
            'description'  => 'installer_description',
            'attachment'   => 'installer_attachment',
            'remarks'      => 'installer_remarks',
            'status'       => 'installer_status',
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

            $data[$dbKey] = in_array($inputKey, ['name', 'description']) ? valueOrNA($value) : $value;
        }

        return $data;
    }

    public function add()
    {
        $post = $this->request->getPost();
        $file = $this->request->getFile('attachment');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $post['attachment'] = file_get_contents($file->getTempName());
        }

        $installerData = $this->extractData($post);

        if ($this->installerObj->insert($installerData)) {
            $this->logActivity('create', 'Installer', 'Successfully added an installer.');
            return redirect()->back()->with('success', 'Installer added successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to add installer.')
            ->with('errors', $this->installerObj->errors());
    }

    public function fetchAll()
    {
        $installerData = $this->installerObj->findAll();
        $data = [];
        $viewModalId = 'viewInstallerModal';
        $index = 1;

        foreach ($installerData as $row) {
            $id = $row['installer_id'];
            $data[] = [
                $index++,
                $id,
                $row['installer_name'] ?? 'N/A',
                $row['installer_description'] ?? '',
                $row['installer_remarks'] ?? '',
                $row['installer_status'] ?? '',
                view('components/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/installer/{$id}"),
                    'viewModalId' => $viewModalId,
                    'delete'      => base_url("api/installer/delete/{$id}"),
                    'archive'     => base_url("api/installer/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $data = $this->installerObj->find($id);

        if ($data) {
            return $this->response->setJSON([
                'data' => $data,
                'status' => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Item not found.',
        ])->setStatusCode(404);
    }

    public function update($id)
    {
        if (!$this->installerObj->find($id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Item not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getRawInput();
        $data = $this->extractData($post);

        if ($this->installerObj->update($id, $data)) {
            $this->logActivity('update', 'Installer', 'Successfully updated an installer.');
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data successfully updated!',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update data.',
            'errors' => $this->installerObj->errors(),
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
        $record = $this->installerObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role') ?? "admin",
            "{$type}d_email"       => session('email') ?? "admin@gmail.com",
            "{$type}d_item_type"   => "installer",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "the item is {$type}d",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->installerObj->delete($id)) {
            $this->logActivity($type, 'Installer', "Successfully {$type}d an installer.");
            return redirect()->back()->with('success', "Installer successfully {$type}d!");
        }

        return redirect()->back()
            ->with('error', "Failed to {$type} installer.")
            ->with('errors', $this->installerObj->errors());
    }

    public function getStats()
    {
        $total    = $this->installerObj->countAll();
        $active   = $this->installerObj->where('installer_status', 'Active')->countAllResults();
        $inactive = $this->installerObj->where('installer_status !=', 'Active')->countAllResults();
        $archived = $this->installerObj->where('installer_status', 'Archived')->countAllResults();

        return $this->response->setJSON([
            'total'    => $total,
            'active'   => $active,
            'inactive' => $inactive,
            'archived' => $archived,
        ]);
    }

    public function viewAttachment($id)
    {
        $data = $this->installerObj->find($id);

        if (!$data || empty($data['installer_attachment'])) {
            return $this->response->setStatusCode(404)->setBody('Attachment not found.');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf') // Change MIME if needed
            ->setHeader('Content-Disposition', 'inline; filename="installer_attachment.pdf"')
            ->setBody($data['installer_attachment']);
    }
}
