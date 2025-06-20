<?php

namespace App\Controllers\Attendance;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ActivityLoggerTrait;

class AttendanceController extends BaseController
{
    use ActivityLoggerTrait;

    /**
     * Maps user input keys to DB column keys and filters empty values.
     */
    private function extractData(array $post): array
    {
        $fields = [
            "status"             => "attendance_status",
            "days_present"       => "attendance_total_days_present",
            "leave"              => "attendance_leave",
            "approved"           => "attendance_approved",
            "user_id"            => "user_id_fk",
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

        if ($this->attendanceObj->insert($data)) {
            $this->logActivity('create', 'Attendance', 'Successfully added attendance record.');
            return redirect()->back()->with('success', 'Attendance added successfully.');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to add attendance.')
            ->with('errors', $this->attendanceObj->errors());
    }

    public function fetchAll()
    {
        $attendanceData = $this->attendanceObj->findAll();
        $data = [];
        $viewModalId = 'viewAttendanceModal';
        $index = 1;

        foreach ($attendanceData as $row) {
            $id = $row['attendance_id'];
            $data[] = [
                $index++,
                $row['attendance_status'] ?? 'N/A',
                $row['attendance_total_days_present'] ?? 0,
                $row['attendance_leave'] ?? 0,
                $row['attendance_approved'] ?? 0,
                $row['attendance_createdAt'] ?? '',
                view('components/buttons/action_button', [
                    'id'          => $id,
                    'view'        => base_url("api/attendance/{$id}"),
                    'viewModalId' => $viewModalId,
                    'delete'      => base_url("api/attendance/delete/{$id}"),
                    'archive'     => base_url("api/attendance/archive/{$id}"),
                ]),
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function fetch($id)
    {
        $data = $this->attendanceObj->find($id);

        if ($data) {
            array_walk_recursive($data, function (&$val) {
                if (is_string($val) && !mb_check_encoding($val, 'UTF-8')) {
                    $val = mb_convert_encoding($val, 'UTF-8', 'UTF-8');
                }
            });

            return $this->response->setJSON([
                'data' => $data,
                'status' => 'success',
                'message' => 'Data successfully fetched!',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Attendance record not found.',
        ])->setStatusCode(404);
    }

    public function update($id)
    {
        if (!$this->attendanceObj->find($id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Attendance record not found.',
            ])->setStatusCode(404);
        }

        $post = $this->request->getVar();
        $data = $this->extractData($post);

        if ($this->attendanceObj->update($id, $data)) {
            $this->logActivity('update', 'Attendance', 'Successfully updated an attendance record.');
            return redirect()->back()->with('success', 'Attendance updated successfully.');
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update data.',
            'errors' => $this->attendanceObj->errors()
        ])->setStatusCode(400);
    }

    public function delete($id)
    {
        if ($row = $this->attendanceObj->find($id)) {
            $deleted = [
                'deleted_role'       => $_SESSION['role'],
                'deleted_email'      => $_SESSION['email'],
                'deleted_item_type'  => 'attendance',
                'deleted_item_data'  => json_encode($row),
                'deleted_description'=> 'The item is deleted'
            ];

            if ($this->deletedFileObj->insert($deleted)) {
                if ($this->attendanceObj->delete($id)) {
                    return redirect()->back()->with('success', 'Attendance record successfully deleted!');
                }
            }
        }

        return redirect()->back()->with('error', 'Attendance record not found or deletion failed.');
    }

    public function archive($id)
    {
        if ($row = $this->attendanceObj->find($id)) {
            $archived = [
                'archived_role'        => $_SESSION['role'],
                'archived_email'       => $_SESSION['email'],
                'archived_item_type'   => 'attendance',
                'archived_item_data'   => json_encode($row),
                'archived_description' => 'The item is archived'
            ];

            if ($this->archivedFileObj->insert($archived)) {
                if ($this->attendanceObj->delete($id)) {
                    return redirect()->back()->with('success', 'Attendance record successfully archived!');
                }
            }
        }

        return redirect()->back()->with('error', 'Attendance record not found or archiving failed.');
    }

    public function getStats()
    {
        $total    = $this->attendanceObj->countAll();
        $present  = $this->attendanceObj->where('attendance_status', 'Present')->countAllResults();
        $absent   = $this->attendanceObj->where('attendance_status', 'Absent')->countAllResults();
        $leave = $this->attendanceObj->where('attendance_status', 'Leave')->countAllResults();

        return $this->response->setJSON([
            'total'    => $total,
            'present'  => $present,
            'absent'   => $absent,
            'leave' => $leave,
        ]);
    }
}
