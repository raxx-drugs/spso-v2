<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Traits\ActivityLoggerTrait;
class DownloadController extends BaseController
{
    use ActivityLoggerTrait;
    /**
     * Maps user input keys to DB column keys and filters empty values.
     */
    private function extractData(array $post): array
    {
        $fields = [
            "file_name"     => "download_file_name",
            "file_type"     => "download_file_type",
            "file"          => "download_file",
            "remarks"       => "download_remarks",
            "permission"    => "download_permission",
            "status"        => "download_status",
            "expiry_date"   => "download_expiry_date",
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

            $data[$dbKey] = in_array($inputKey, ['remarks']) ? valueOrNA($value) : $value;
        }

        return $data;
    }
    public function add()
    {
        $post = $this->request->getPost();
        $file = $this->request->getFile('file');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $binary = file_get_contents($file->getTempName());
            
            $post['file']        = $binary;
            $post['file_name']   = $file->getClientName();
            $post['file_type']   = $file->getClientMimeType();
        }

        $downloadData = $this->extractData($post);

        // Attach file data if present
        if (!empty($post['file'])) {
            $downloadData['download_file']        = $post['file'];
            $downloadData['download_file_name']    = $post['file_name'];
            $downloadData['download_file_type']   = $post['file_type'];
        }

        if ($this->downloadObj->insert($downloadData)) {
            // pinagdagdag na message
            $this->logActivity('create', 'Downloads', 'Successfully added office supply.');
            return redirect()->back()->with('success', 'Download added successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to add download.')
            ->with('errors', $this->downloadObj->errors());
    }

    public function fetchAll()
    {
        $downloadData = $this->downloadObj->findAll();
        $data = [];

        $viewModalId = 'viewDownloadModal';
        $index = 1; // Start counter at 1   

        foreach ($downloadData as $row) {
            $id = $row['download_id'];
            $data[] = [
                $index++, // Use incremented index instead of actual ID
                $row['download_file_name'] ?? 'N/A',
                $row['download_file_type'] ?? '',
                $row['download_remarks'] ?? '',
                $row['download_permission'] ?? '',
                format_status($row['download_status'] ?? 'N/A'),
                $row['download_expiry_date'] ?? '',
                view('components/buttons/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/download/{$id}"),
                    'viewModalId' => $viewModalId,
                    'delete'      => base_url("api/download/delete/{$id}"),
                    'archive'     => base_url("api/download/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }
    public function fetch($id)
    {
        $downloadData = $this->downloadObj->find($id);

        if ($downloadData) {
            // Fix malformed UTF-8 characters
            array_walk_recursive($downloadData, function (&$val) {
                if (is_string($val) && !mb_check_encoding($val, 'UTF-8')) {
                    $val = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
                }
            });

            return $this->response->setJSON([
                'data' => $downloadData,
                'status' => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Download not found.',
        ])->setStatusCode(404);
    }


    public function update($id)
    {
        if (!$this->downloadObj->find($id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Item not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getVar(); 
        $downloadData = $this->extractData($post);

        if ($this->downloadObj->update($id, $downloadData)) {
            $this->logActivity('update', 'Download', 'Successfully updated a download item.');
            return redirect()->back()->with('success', 'Download updated successfully.');
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update data.',
            'errors' => $this->downloadObj->errors()
        ])->setStatusCode(400);
    }
    public function delete($id)
    {
        if ($downloadData = $this->downloadObj->find($id)) {
            $dataToDelete = [
                "deleted_role" => $_SESSION['role'],
                "deleted_email" => $_SESSION['email'],
                "deleted_item_type" => "download",
                "deleted_item_data" => json_encode($downloadData),
                "deleted_description" => "the item is deleted"
            ];

            if ($this->deletedFileObj->insert($dataToDelete)) {
                if ($this->downloadObj->delete($id)) {
                    
                   return redirect()->back()->with('success', 'Download Data successfully deleted!');
                   
                } else {
                     return redirect()->back()
                    ->with('error', 'Failed to delete download.')
                    ->with('errors', $this->downloadObj->errors());
                }
            }
        }
        return redirect()->back()->with('error', 'Download not found.');
    }    
    public function archive($id)
    {
        if ($downloadData = $this->downloadObj->find($id)) {
            $dataToArchive = [
                "archived_role" => $_SESSION['role'],
                "archived_email" => $_SESSION['email'],
                "archived_item_type" => "download",
                "archived_item_data" => json_encode($downloadData),
                "archived_description" => "the item is archived"
            ];

            if ($this->archivedFileObj->insert($dataToArchive)) {
                if ($this->downloadObj->delete($id)) {
                   return redirect()->back()->with('success', 'Download Data successfully archived!');
                } else {
                     return redirect()->back()
                    ->with('error', 'Failed to delete download.')
                    ->with('errors', $this->downloadObj->errors());
                }
            }
        }
        return redirect()->back()->with('error', 'Download not found.');
    }
    public function getStats()
    {
        $total    = $this->downloadObj->countAll();
        $active   = $this->downloadObj->where('download_status', 'Available')->countAllResults();
        $expired  = $this->downloadObj->where('download_expiry_date <', date('Y-m-d'))->countAllResults();
        $archived = $this->downloadObj->where('download_status', 'Archived')->countAllResults();

        return $this->response->setJSON([
            'total'    => $total,
            'active'   => $active,
            'expired'  => $expired,
            'archived' => $archived,
        ]);
    }


    // dont touch this
    public function viewFile($id)
    {
        $fileData = $this->downloadObj->find($id);

        if (!$fileData || empty($fileData['download_file'])) {
            return $this->response->setStatusCode(404)->setBody('File not found.');
        }

        $filename  = $fileData['download_file_name'] ?? 'file.txt';
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        

        // If file is already a PDF, display it directly
        if (strtolower($extension) === 'pdf') {
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
                ->setBody($fileData['download_file']);
        }

        // Convert to PDF (e.g., for plain text, code)
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $safeText = htmlspecialchars($fileData['download_file']); // prevent XSS
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
        $fileData = $this->downloadObj->find($id);

        if (!$fileData || empty($fileData['download_file'])) {
            return $this->response->setStatusCode(404)->setBody('File not found.');
        }

        $filename = $fileData['download_file_name'] ?? 'downloaded_file';
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
            $guessedExt = $mimeToExt[$fileData['download_file_type']] ?? 'bin';
            $filename .= '.' . $guessedExt;
        }

        $mimeType = $fileData['download_file_type'] ?? 'application/octet-stream';

        $this->logActivity("download", "File", "Downloaded a {$filename} file.");
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($fileData['download_file']);
    }
}
