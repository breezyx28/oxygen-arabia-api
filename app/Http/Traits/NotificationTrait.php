<?php

namespace App\Http\Traits;

use App\Models\Notification;
use Error;
use Illuminate\Http\Request;

trait NotificationTrait
{
    public function send_notification($type = 'basic', $message, $for = null)
    {
        $noti = new Notification();

        if ($for != null) {
            $noti->notification_for_id = $for;
        }

        $noti->notification_owner_id = auth()->user()->id;

        if (in_array($type, ['basic', 'danger', 'warn', 'ban', 'info'])) {
            $noti->type = $type;
        }

        $noti->message = $message;

        try {
            $noti->save();
            return response()->json([
                'message' => 'notification has been sent successfully',
                'data' => $noti
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $th->getMessage()
            ], 200);
        }
    }
}
