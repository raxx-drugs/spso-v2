<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class ItEquipmentController extends BaseController
{
    use ActivityLoggerTrait;

    /**
     * Extract and map input data for IT equipment.
     */
    private function extractData(array $post): array
    {
        $fields = [
            "image"             => "it_equipment_image",
            "unit"              => "it_equipment_unit",
            "serial_number"     => "it_equipment_serial_number",
            "system_no"         => "it_equipment_system_no",
            "requisition"       => "it_equipment_requisition",
            "stock"             => "it_equipment_stock",
            "status"            => "it_equipment_status",
            "unit_value"        => "it_equipment_unit_value",
            "remarks"           => "it_equipment_remarks",
        ];

        $data = [];

        foreach ($fields as $inputKey => $dbKey) {
            if (!array_key_exists($inputKey, $post)) continue;

            $value = $post[$inputKey];

            if ($value === null || (is_string($value) && trim($value) === '')) continue;

            $data[$dbKey] = in_array($inputKey, ['unit', 'remarks']) ? valueOrNA($value) : $value;
        }

        return $data;
    }

    /**
     * Add new IT equipment.
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

    // Attach file data if present
    if (!empty($post['image'])) {
        $data['it_equipment_image'] = $post['image'];
    }

    if ($this->itEquipmentObj->insert($data)) {
        // pinagdagdag na message
        $this->logActivity('create', 'IT Equipment', 'Successfully added IT equipment.');
        return redirect()->back()->with('success', 'IT Equipment added successfully.');
    }

    return redirect()->back()
        ->withInput()
        ->with('error', 'Failed to add IT Equipment.')
        ->with('errors', $this->itEquipmentObj->errors());
}


    /**
     * Fetch all IT equipment.
     */
 public function fetchAll()
{
    $equipmentData = $this->itEquipmentObj->findAll();
    $data = [];

    $viewModalId = 'viewEquipmentModal';
    $index = 1; // Start counter at 1

    foreach ($equipmentData as $row) {
        $id = $row['it_equipment_id'];
        $data[] = [
            $index++, // Use incremented index instead of actual ID
            $row['it_equipment_unit'] ?? 'N/A',
            $row['it_equipment_serial_number'] ?? '',
            format_status($row['it_equipment_status'] ?? 'N/A'),
            view('components/buttons/action_button', [
                'id'          => $id,
                'view'        => base_url("api/inventory/it-equipment/{$id}"),
                'viewModalId' => $viewModalId,
                'delete'      => base_url("api/inventory/it-equipment/delete/{$id}"),
                'archive'     => base_url("api/inventory/it-equipment/archive/{$id}"),
            ]),
        ];
    }

    return $this->response->setJSON(['data' => $data]);
}

    /**
     * Fetch single IT equipment.
     */
 public function fetch($id)
{
    $item = $this->itEquipmentObj->find($id);

    if ($item) {
        // Fix malformed UTF-8 characters
        array_walk_recursive($item, function (&$val) {
            if (is_string($val) && !mb_check_encoding($val, 'UTF-8')) {
                $val = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
            }
        });

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
     * Update IT equipment.
     */
   public function update($id)
{
    if (!$this->itEquipmentObj->find($id)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Item not found.',
        ])->setStatusCode(404);
    }

    $post = $this->request->getVar(); // Changed from getRawInput() to match template
    $data = $this->extractData($post);

    if ($this->itEquipmentObj->update($id, $data)) {
        $this->logActivity('update', 'IT Equipment', 'Successfully updated IT equipment.');
        return redirect()->back()->with('success', 'IT Equipment updated successfully.');
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Failed to update data.',
        'errors' => $this->itEquipmentObj->errors()
    ])->setStatusCode(400);
}

    /**
     * Archive IT equipment.
     */
  public function archive($id)
{
    if ($itEquipmentData = $this->itEquipmentObj->find($id)) {
        $dataToArchive = [
            "archived_role"        => $_SESSION['role'],
            "archived_email"       => $_SESSION['email'],
            "archived_item_type"   => "it_equipment",
            "archived_item_data"   => json_encode($itEquipmentData),
            "archived_description" => "the item is archived"
        ];

        if ($this->archivedFileObj->insert($dataToArchive)) {
            if ($this->itEquipmentObj->delete($id)) {
                return redirect()->back()->with('success', 'IT Equipment data successfully archived!');
            } else {
                return redirect()->back()
                    ->with('error', 'Failed to delete IT Equipment.')
                    ->with('errors', $this->itEquipmentObj->errors());
            }
        }
    }

    return redirect()->back()->with('error', 'IT Equipment not found.');
}

    /**
     * Delete IT equipment.
     */
  public function delete($id)
{
    if ($itEquipmentData = $this->itEquipmentObj->find($id)) {
        $dataToDelete = [
            "deleted_role"        => $_SESSION['role'],
            "deleted_email"       => $_SESSION['email'],
            "deleted_item_type"   => "it_equipment",
            "deleted_item_data"   => json_encode($itEquipmentData),
            "deleted_description" => "the item is deleted"
        ];

        if ($this->deletedFileObj->insert($dataToDelete)) {
            if ($this->itEquipmentObj->delete($id)) {
                return redirect()->back()->with('success', 'IT Equipment data successfully deleted!');
            } else {
                return redirect()->back()
                    ->with('error', 'Failed to delete IT Equipment.')
                    ->with('errors', $this->itEquipmentObj->errors());
            }
        }
    }

    return redirect()->back()->with('error', 'IT Equipment not found.');
}
    // DI KO TO GINAGALAW "private function handleRemoveOrArchive($id, $type = 'archive')"
    private function handleRemoveOrArchive($id, $type = 'archive')
    {
        $record = $this->itEquipmentObj->find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $logData = [
            "{$type}d_role"        => session('role') ?? "admin",
            "{$type}d_email"       => session('email') ?? "admin@gmail.com",
            "{$type}d_item_type"   => "it_equipment",
            "{$type}d_item_data"   => json_encode($record),
            "{$type}d_description" => "The item is {$type}d.",
        ];

        $logObj = $type === 'archive' ? $this->archivedFileObj : $this->deletedFileObj;

        if ($logObj->insert($logData) && $this->itEquipmentObj->delete($id)) {
            $this->logActivity($type, 'IT Equipment', "Successfully {$type}d IT equipment.");
            return redirect()->back()->with('success', "Item {$type}d successfully.");
        }

        return redirect()->back()->with('error', "Failed to {$type} item.")
            ->with('errors', $this->itEquipmentObj->errors());
    }

    /**
     * Get IT equipment statistics.
     */
    public function getStats()
    {
        $total = $this->itEquipmentObj->countAll();
        $working = $this->itEquipmentObj->where('it_equipment_status', 'Working')->countAllResults();
        $damaged = $this->itEquipmentObj->where('it_equipment_status', 'Damaged')->countAllResults();
        $disposal = $this->itEquipmentObj->where('it_equipment_status', 'Disposal')->countAllResults();

        return $this->response->setJSON([
            'total' => $total,
            'working' => $working,
            'damaged' => $damaged,
            'disposal' => $disposal,
        ]);
    }


    // dont touch this
    /**
     * View image inline.
     */
    public function viewImage($id)
    {
        $data = $this->itEquipmentObj->find($id);

        if (!$data || empty($data['it_equipment_image'])) {
            return $this->response->setStatusCode(404)->setBody('Image not found.');
        }

        return $this->response
            ->setHeader('Content-Type', 'image/jpeg')
            ->setHeader('Content-Disposition', 'inline; filename="equipment_image.jpg"')
            ->setBody($data['it_equipment_image']);
    }

    /**
     * Download original image.
     */
    public function downloadOriginal($id)
    {
        $data = $this->itEquipmentObj->find($id);

        if (!$data || empty($data['it_equipment_image'])) {
            return $this->response->setStatusCode(404)->setBody('Image not found.');
        }

        $this->logActivity('download', 'Image', 'Downloaded IT equipment image.');

        return $this->response
            ->setHeader('Content-Type', 'image/jpeg')
            ->setHeader('Content-Disposition', 'attachment; filename="equipment_image.jpg"')
            ->setBody($data['it_equipment_image']);
    }
}
