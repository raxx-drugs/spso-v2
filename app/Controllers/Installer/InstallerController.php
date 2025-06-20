<?php

namespace App\Controllers\Installer;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Traits\ActivityLoggerTrait;
use App\Traits\NotificationTrait;

class InstallerController extends BaseController
{
    use ActivityLoggerTrait,NotificationTrait;

    /**
     * Extracts installer data from the request post.
     */
    private function extractData(array $post): array
    {
        $fields = [
            'image'        => 'installer_image',//save as binary
            'name'         => 'installer_name',
            'description'  => 'installer_description',
            'file_name'    => 'installer_file_name',
            'file_type'    => 'installer_file_type',
            'file'         => 'installer_file',
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

            $data[$dbKey] = in_array($inputKey, ['description']) ? valueOrNA($value) : $value;
        }

        return $data;
    }

    public function add()
    {
        $post = $this->request->getPost();
        $file = $this->request->getFile('file');
        $image = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $binary = file_get_contents($file->getTempName());
            
            $post['file']        = $binary;
            $post['file_name']   = $file->getClientName();
            $post['file_type']   = $file->getClientMimeType();
        }

        // Handle image upload as binary
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $post['image'] = file_get_contents($image->getTempName());
        }


        $installerData = $this->extractData($post);
        // Attach file data if present
        if (!empty($post['file'])) {
            $installerData['installer_file']        = $post['file'];
            $installerData['installer_file_name']   = $post['file_name'];
            $installerData['installer_file_type']   = $post['file_type'];
        }

        // Image binary (already handled by extractData if present in $post)
        if (!empty($post['image'])) {
            $installerData['installer_image'] = $post['image'];
        }

        if ($this->installerObj->insert($installerData)) {
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
        $index = 1; // Start counter at 1

        foreach ($installerData as $row) {
            $id = $row['installer_id'];

            // Convert binary image to base64 (if exists)
            $imageData = $row['installer_image'] ?? null;
            $imageElement = 'N/A';

            if ($imageData) {
                $base64 = base64_encode($imageData);
                $imageElement = '<img src="data:image/jpeg;base64,' . $base64 . '" width="40" height="40" style="object-fit: cover; border-radius: 4px;" />';
            }
            // Generate download link
            $downloadUrl = base_url("api/installer/originalFile/{$id}");
            $downloadLink = "<a href='{$downloadUrl}' class='btn btn-sm btn-outline-primary' download>Download File</a>";


            $data[] = [
                $index++, // Use incremented index instead of actual ID
                $imageElement,
                $row['installer_name'] ?? 'N/A',
                $row['installer_description'] ?? '',
                $row['installer_file_name'] ?? 'N/A',
                $row['installer_file_type'] ?? '',
                $row['installer_remarks'] ?? '',
                format_status($row['installer_status'] ?? 'N/A'),
                $downloadLink,
                
                // view('components/buttons/action_button', [
                //     'id'          => $id,
                //     'view'        => base_url("api/installer/{$id}"),
                //     // 'download'      => $downloadLink,
                //     'delete'      => base_url("api/installer/delete/{$id}"),
                //     'archive'     => base_url("api/installer/archive/{$id}"),
                // ]),
                
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $installerData = $this->installerObj->find($id);

          if ($installerData) {
            // Fix malformed UTF-8 characters
            array_walk_recursive($installerData, function (&$val) {
                if (is_string($val) && !mb_check_encoding($val, 'UTF-8')) {
                    $val = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
                }
            });

            return $this->response->setJSON([
                'data' => $installerData,
                'status' => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Installer not found.',
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

    public function delete($id)
    {
        if ($installerData = $this->installerObj->find($id)) {
            $dataToDelete = [
                "deleted_role" => $_SESSION['role'],
                "deleted_email" => $_SESSION['email'],
                "deleted_item_type" => "installer",
                "deleted_item_data" => json_encode($installerData),
                "deleted_description" => "the item is deleted"
            ];

            if ($this->deletedFileObj->insert($dataToDelete)) {
                if ($this->installerObj->delete($id)) {
                    
                   return redirect()->back()->with('success', 'Installer Data successfully deleted!');
                   
                } else {
                     return redirect()->back()
                    ->with('error', 'Failed to delete installer.')
                    ->with('errors', $this->installerObj->errors());
                }
            }
        }
        return redirect()->back()->with('error', 'Download not found.');
    }
    public function archive($id)
    {
        if ($installerData = $this->installerObj->find($id)) {
            $dataToArchive = [
                "archived_role"        => $_SESSION['role'],
                "archived_email"       => $_SESSION['email'],
                "archived_item_type"   => "installer",
                "archived_item_data"   => json_encode($installerData),
                "archived_description" => "the item is archived"
            ];

            if ($this->archivedFileObj->insert($dataToArchive)) {
                if ($this->installerObj->delete($id)) {
                    return redirect()->back()->with('success', 'Installer data successfully archived!');
                } else {
                    return redirect()->back()
                        ->with('error', 'Failed to delete installer.')
                        ->with('errors', $this->installerObj->errors());
                }
            }
        }

        return redirect()->back()->with('error', 'Installer not found.');
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

    public function viewFile($id)
    {
        $fileData = $this->installerObj->find($id);

        if (!$fileData || empty($fileData['installer_file'])) {
            return $this->response->setStatusCode(404)->setBody('File not found.');
        }

        $filename  = $fileData['installer_file_name'] ?? 'file.txt';
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        

        // If file is already a PDF, display it directly
        if (strtolower($extension) === 'pdf') {
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
                ->setBody($fileData['installer_file']);
        }

        // Convert to PDF (e.g., for plain text, code)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $safeText = htmlspecialchars($fileData['installer_file']); // prevent XSS
        $html     = "<pre style='font-family: monospace;'>{$safeText}</pre>";

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="preview.pdf"')
            ->setBody($dompdf->output());
    }
    public function downloadOriginal($id)
    {
        $fileData = $this->installerObj->find($id);

        if (!$fileData || empty($fileData['installer_file'])) {
            return $this->response->setStatusCode(404)->setBody('File not found.');
        }

        $filename = $fileData['installer_file_name'] ?? 'installer_file';
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // Append extension if missing
        if (!$extension) {
            $mimeToExt = [
                'application/pdf'        => 'pdf',
                'text/plain'             => 'txt',
                'application/javascript' => 'js',
                'text/css'               => 'css',
                'text/html'              => 'html',
                'application/json'       => 'json',
                'image/jpeg'             => 'jpg',
                'image/png'              => 'png',
                'application/zip'        => 'zip',
            ];
            $guessedExt = $mimeToExt[$fileData['installer_file_type']] ?? 'bin';
            $filename .= '.' . $guessedExt;
        }

        $mimeType = $fileData['installer_file_type'] ?? 'application/octet-stream';

        $this->logActivity("installer", "File", "Installer a {$filename} file.");
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($fileData['installer_file']);
    }
}
