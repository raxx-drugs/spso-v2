<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class AnnouncementController extends BaseController
{
    use ActivityLoggerTrait;

    /**
     * Extracts and maps incoming POST data to model fields.
     */
    private function extractData(array $post): array
    {
        $fields = [
            "title"        => "announcement_title",
            "description"  => "announcement_description",
            "category"     => "announcement_category",
            "status"       => "announcement_status",
            "expiry_date"  => "announcement_expiry_date",
            "attachment"   => "announcement_attachment", // raw binary
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

            $data[$dbKey] = in_array($inputKey, ['title', 'description']) ? valueOrNA($value) : $value;
        }

        return $data;
    }

    /**
     * Handles creation of a new announcement.
     */
    public function add()
    {
        $post = $this->request->getPost();
        $file = $this->request->getFile('attachment');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $binary = file_get_contents($file->getTempName());
            $post['attachment'] = $binary;
        }

        $announcementData = $this->extractData($post);

        if ($this->announcementObj->insert($announcementData)) {
            $this->logActivity('create', 'Announcement', 'Successfully added an announcement.');
            return redirect()->back()->with('success', 'Announcement added successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to add announcement.')
            ->with('errors', $this->announcementObj->errors());
    }

    public function fetchAll()
    {
        $announcementData = $this->announcementObj->findAll();
        $data = [];
        $viewModalId = 'viewAnnouncementModal';
        $index = 1;

        foreach ($announcementData as $row) {
            $id = $row['announcement_id'];
            $data[] = [
                $index++,
                $id,
                $row['announcement_title'] ?? 'N/A',
                $row['announcement_category'] ?? '',
                $row['announcement_status'] ?? '',
                $row['announcement_expiry_date'] ?? '',
                view('components/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/announcement/{$id}"),
                    'viewModalId' => $viewModalId,
                    'delete'      => base_url("api/announcement/delete/{$id}"),
                    'archive'     => base_url("api/announcement/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $announcementData = $this->announcementObj->find($id);

        if ($announcementData) {
            return $this->response->setJSON([
                'data' => $announcementData,
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
        if (!$this->announcementObj->find($id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Item not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getRawInput();
        $announcementData = $this->extractData($post);

        if ($this->announcementObj->update($id, $announcementData)) {
            $this->logActivity('update', 'Announcement', 'Successfully updated an announcement.');
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data successfully updated!',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update data.',
            'errors' => $this->announcementObj->errors()
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
        $record = $this->announcementObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role') ?? "admin",
            "{$type}d_email"       => session('email') ?? "admin@gmail.com",
            "{$type}d_item_type"   => "announcement",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "the item is {$type}d",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->announcementObj->delete($id)) {
            $this->logActivity($type, "Announcement", "Successfully {$type}d an announcement.");
            return redirect()->back()->with('success', "Announcement successfully {$type}d!");
        }

        return redirect()->back()
            ->with('error', "Failed to {$type} announcement.")
            ->with('errors', $this->announcementObj->errors());
    }

    public function getStats()
    {
        $total    = $this->announcementObj->countAll();
        $active   = $this->announcementObj->where('announcement_status', 'Active')->countAllResults();
        $expired  = $this->announcementObj->where('announcement_expiry_date <', date('Y-m-d'))->countAllResults();
        $archived = $this->announcementObj->where('announcement_status', 'Archived')->countAllResults();

        return $this->response->setJSON([
            'total'    => $total,
            'active'   => $active,
            'expired'  => $expired,
            'archived' => $archived,
        ]);
    }

    public function viewAttachment($id)
    {
        $data = $this->announcementObj->find($id);

        if (!$data || empty($data['announcement_attachment'])) {
            return $this->response->setStatusCode(404)->setBody('Attachment not found.');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf') // Adjust if needed
            ->setHeader('Content-Disposition', 'inline; filename="attachment.pdf"')
            ->setBody($data['announcement_attachment']);
    }
}
