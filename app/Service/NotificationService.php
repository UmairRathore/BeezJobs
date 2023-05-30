<?php

namespace App\Service;

use App\Models\Notification;

class NotificationService implements  NotificationServiceInterface
{

    public function sendNotification($message, $user_id)
    {

                $notification = new Notification();
        $notification->message = $message;
        $notification->user_id = $user_id;
        $notification->save();


        echo "Message sent to pushover! \n";

    }
}
