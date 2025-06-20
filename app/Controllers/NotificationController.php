<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class NotificationController extends BaseController
{

    public function fetchAll()
    {
        $notifications = $this->notificationObj
            ->where('is_archived', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = array_map(function ($notif) {
            return [
                'id' => $notif['id'],
                'type' => $notif['type'], // e.g., 'request', 'info', 'update'
                'title' => $notif['title'],
                'message' => $notif['message'],
                'sender_name' => $notif['sender_name'],
                'sender_image' => base_url('uploads/' . $notif['sender_image']),
                'created_at' => time_elapsed_string($notif['created_at']),
                'action_required' => in_array($notif['type'], ['request']),
            ];
        }, $notifications);

        return $this->response->setJSON(['notifications' => $data]);
    }
}
