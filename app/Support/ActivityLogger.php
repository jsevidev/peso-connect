<?php

namespace App\Support;

use App\Models\ActivityLog;

class ActivityLogger
{
    public static function record(?int $adminId, string $action, ?string $details = null): ActivityLog
    {
        return ActivityLog::create([
            'admin_id' => $adminId,
            'action' => $action,
            'details' => $details,
        ]);
    }
}
