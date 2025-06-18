<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class OfficeSupplyController extends BaseController
{
    use ActivityLoggerTrait;

    /**
     * Extract and map input data for Office Supply.
     */
    private function extractData(array $post): array
    {
        $fields = [
            'image'         => 'office_supply_image',
            'name'          => 'office_supply_name',
            'code'          => 'office_supply_code',
            'category'      => 'office_supply_category',
            'stocks'        => 'office_supply_stocks',
            'status'        => 'office_supply_status',
            'description'   => 'office_supply_description',
        ];

        $data = [];

        foreach ($fields as $inputKey => $dbKey) {
            if (!array_key_exists($inputKey, $post)) continue;

            $value = $post[$inputKey];

            if ($value === null || (is_string($value) && trim($value) === '')) continue;

            $data[$dbKey] = in_array($inputKey, ['description']) ? valueOrNA($value) : $value;
        }

        return $data;
    }

    /**
     * Add new office supply.
     */
    public function add()
    {
        $post = $this->request->getPost();
        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $binary = file_get_contents($file->getTempName());
            $post['image'] = $binary;
        }

        $data = $this->extractData($post);

        if ($this->officeSupplyObj->insert($data)) {
            $this->logActivity('create', 'Office Supply', 'Successfully added office supply.');
            return redirect()->back()->with('success', 'Office supply added successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to add office supply.')
            ->with('errors', $this->officeSupplyObj->errors());
    }

    /**
     * Fetch all office supplies.
     */
    public function fetchAll()
    {
        $items = $this->officeSupplyObj->findAll();
        $data = [];
        $viewModalId = 'viewOfficeSupplyModal';
        $index = 1;

        foreach ($items as $row) {
            $id = $row['office_supply_id'];
            $data[] = [
                $index++,
                $id,
                $row['office_supply_name'] ?? '',
                $row['office_supply_code'] ?? '',
                $row['office_supply_category'] ?? '',
                $row['office_supply_stocks'] ?? '',
                $row['office_supply_status'] ?? '',
                $row['office_supply_description'] ?? '',
                view('components/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/office-supply/{$id}"),
                    'viewModalId' => $viewModalId,
                    'delete'      => base_url("api/office-supply/delete/{$id}"),
                    'archive'     => base_url("api/office-supply/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    /**
     * Fetch single office supply.
     */
    public function fetch($id)
    {
        $item = $this->officeSupplyObj->find($id);

        if ($item) {
            return $this->response->setJSON([
                'data' => $item,
                'status' => 'success',
                'message' => 'Data fetched successfully.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Item not found.',
        ])->setStatusCode(404);
    }

    /**
     * Update office supply.
     */
    public function update($id)
    {
        if (!$this->officeSupplyObj->find($id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Item not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getRawInput();
        $data = $this->extractData($post);

        if ($this->officeSupplyObj->update($id, $data)) {
            $this->logActivity('update', 'Office Supply', 'Updated office supply.');
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data updated successfully.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update.',
            'errors' => $this->officeSupplyObj->errors(),
        ])->setStatusCode(400);
    }

    /**
     * Archive office supply.
     */
    public function archive($id)
    {
        return $this->handleRemoveOrArchive($id, 'archive');
    }

    /**
     * Delete office supply.
     */
    public function delete($id)
    {
        return $this->handleRemoveOrArchive($id, 'delete');
    }

    private function handleRemoveOrArchive($id, $type = 'archive')
    {
        $record = $this->officeSupplyObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role') ?? "admin",
            "{$type}d_email"       => session('email') ?? "admin@gmail.com",
            "{$type}d_item_type"   => "office_supply",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "The item is {$type}d.",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->officeSupplyObj->delete($id)) {
            $this->logActivity($type, 'Office Supply', "Successfully {$type}d office supply.");
            return redirect()->back()->with('success', "Item {$type}d successfully.");
        }

        return redirect()->back()->with('error', "Failed to {$type} item.")
            ->with('errors', $this->officeSupplyObj->errors());
    }

    /**
     * Get office supply statistics.
     */
    public function getStats()
    {
        $total = $this->officeSupplyObj->countAll();
        $active = $this->officeSupplyObj->where('office_supply_status', 'Active')->countAllResults();
        $inactive = $this->officeSupplyObj->where('office_supply_status', 'Inactive')->countAllResults();
        $archived = $this->officeSupplyObj->where('office_supply_status', 'Archived')->countAllResults();

        return $this->response->setJSON([
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive,
            'archived' => $archived,
        ]);
    }

    /**
     * View image inline.
     */
    public function viewImage($id)
    {
        $data = $this->officeSupplyObj->find($id);

        if (!$data || empty($data['office_supply_image'])) {
            return $this->response->setStatusCode(404)->setBody('Image not found.');
        }

        return $this->response
            ->setHeader('Content-Type', 'image/jpeg')
            ->setHeader('Content-Disposition', 'inline; filename="office_supply.jpg"')
            ->setBody($data['office_supply_image']);
    }

    /**
     * Download original image.
     */
    public function downloadOriginal($id)
    {
        $data = $this->officeSupplyObj->find($id);

        if (!$data || empty($data['office_supply_image'])) {
            return $this->response->setStatusCode(404)->setBody('Image not found.');
        }

        $this->logActivity('download', 'Image', 'Downloaded office supply image.');

        return $this->response
            ->setHeader('Content-Type', 'image/jpeg')
            ->setHeader('Content-Disposition', 'attachment; filename="office_supply.jpg"')
            ->setBody($data['office_supply_image']);
    }
}
