<?php

namespace App\Traits;

trait NotificationTrait
{
    /**
     * Send a notification.
     *
     * @param string $title
     * @param string $message
     * @param string $type     success, error, info, warning
     * @param string|null $redirect Optional redirect URL (if using flash + redirect)
     * @return void
     */
    public function notify(string $title, string $message, string $type = 'info', string $redirect = null): void
    {
        $notification = [
            'notification_title'   => $title,
            'notification_message' => $message,
            'notification_type'    => $type,
            'notification_time'    => date('Y-m-d H:i:s'),
        ];

        // Flash session for UI notifications (like toastr/sweetalert)
        session()->setFlashdata('notification', $notification);

        // Optionally redirect
        if ($redirect) {
            redirect()->to($redirect)->send();
            exit;
        }
    }

    /**
     * Send a JSON notification (useful for AJAX)
     */
    public function jsonNotify(string $title, string $message, string $type = 'info', array $extra = []): \CodeIgniter\HTTP\Response
    {
        return service('response')->setJSON(array_merge([
            'notification' => [
                'title'   => $title,
                'message' => $message,
                'type'    => $type,
            ],
        ], $extra));
    }
}
