<?php

namespace App\Traits;

trait ActivityLoggerTrait
{
    protected $activityLogObj;

    protected function initActivityLogger()
    {
        if (!$this->activityLogObj) {
            $this->activityLogObj = new \App\Models\ActivityLogModel();
        }
    }

    protected function logActivity(string $actionType, string $targetType, string $description)
    {
        $this->initActivityLogger();

        try {
            $this->activityLogObj->insert([
                'activity_role'         => session('role') ?? 'unknown',
                'activity_name'         => session('user') ?? 'unknown',
                'activity_action_type'  => $actionType,
                'activity_target_type'  => $targetType,
                'activity_description'  => $description,
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Failed to log activity: ' . $e->getMessage());
        }
    }
}
