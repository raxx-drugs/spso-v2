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

        $post['image']      = $binary;
        $post['image_name'] = $file->getClientName();
        $post['image_type'] = $file->getClientMimeType();
    }

    $data = $this->extractData($post);

    // Attach image data if present
    if (!empty($post['image'])) {
        $data['office_supply_image']      = $post['image'];
        $data['office_supply_name'] = $post['image_name'];
        $data['office_supply_type'] = $post['image_type'];
    }

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
        $index = 1; // Start counter at 1

        foreach ($items as $row) {
            $id = $row['office_supply_id'];
            $data[] = [
                $index++, // Use incremented index instead of ID
                $row['office_supply_name'] ?? 'N/A',
                $row['office_supply_code'] ?? '',
                $row['office_supply_category'] ?? '',
                $row['office_supply_stocks'] ?? '',
                format_status($row['office_supply_status'] ?? 'N/A'),
                view('components/buttons/action_button', [ // updated to match template's path
                    'id'          => $id,
                    'view'        => base_url("api/inventory/office-supply/{$id}"),
                    'viewModalId' => $viewModalId,
                    'delete'      => base_url("api/inventory/office-supply/delete/{$id}"),
                    'archive'     => base_url("api/inventory/office-supply/archive/{$id}"),
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
        // Fix malformed UTF-8 characters
        array_walk_recursive($item, function (&$val) {
            if (is_string($val) && !mb_check_encoding($val, 'UTF-8')) {
                $val = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
            }
        });

        return $this->response->setJSON([
            'data' => $item,
            'status' => 'success',
            'message' => 'Data successfully fetched!',
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

    $post = $this->request->getVar(); 
    $data = $this->extractData($post);

    if ($this->officeSupplyObj->update($id, $data)) {
        $this->logActivity('update', 'Office Supply', 'Updated office supply.');
        return redirect()->back()->with('success', 'Office supply updated successfully.');
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Failed to update data.',
        'errors' => $this->officeSupplyObj->errors()
    ])->setStatusCode(400);
}

    /**
     * Archive office supply.
     */
  public function archive($id)
{
    if ($officeSupplyData = $this->officeSupplyObj->find($id)) {
        $dataToArchive = [
            "archived_role"       => $_SESSION['role'],
            "archived_email"      => $_SESSION['email'],
            "archived_item_type"  => "office_supply",
            "archived_item_data"  => json_encode($officeSupplyData),
            "archived_description"=> "the item is archived"
        ];

        if ($this->archivedFileObj->insert($dataToArchive)) {
            if ($this->officeSupplyObj->delete($id)) {
                return redirect()->back()->with('success', 'Office Supply successfully archived!');
            } else {
                return redirect()->back()
                    ->with('error', 'Failed to delete office supply.')
                    ->with('errors', $this->officeSupplyObj->errors());
            }
        }
    }

    return redirect()->back()->with('error', 'Office Supply not found.');
}


    /**
     * Delete office supply.
     */
   public function delete($id)
{
    if ($officeSupplyData = $this->officeSupplyObj->find($id)) {
        $dataToDelete = [
            "deleted_role"        => $_SESSION['role'],
            "deleted_email"       => $_SESSION['email'],
            "deleted_item_type"   => "office_supply",
            "deleted_item_data"   => json_encode($officeSupplyData),
            "deleted_description" => "the item is deleted"
        ];

        if ($this->deletedFileObj->insert($dataToDelete)) {
            if ($this->officeSupplyObj->delete($id)) {
                return redirect()->back()->with('success', 'Office Supply successfully deleted!');
            } else {
                return redirect()->back()
                    ->with('error', 'Failed to delete office supply.')
                    ->with('errors', $this->officeSupplyObj->errors());
            }
        }
    }

    return redirect()->back()->with('error', 'Office Supply not found.');
}


    /**
     * Get office supply statistics.
     */
  public function getStats()
{
    $total    = $this->officeSupplyObj->countAll();
    $working   = $this->officeSupplyObj->where('office_supply_status', 'Working')->countAllResults();
    $damaged = $this->officeSupplyObj->where('office_supply_status', 'Damaged')->countAllResults();
    $disposal = $this->officeSupplyObj->where('office_supply_status', 'Disposal')->countAllResults();

    return $this->response->setJSON([
        'total'    => $total,
        'working'   => $working,
        'damaged' => $damaged,
        'disposal' => $disposal,
    ]);
}





    // DONT TOUCH THIS 
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
