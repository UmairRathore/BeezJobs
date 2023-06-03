<?php

namespace App\Service;

use App\Models\Notification;

class NotificationService implements  NotificationServiceInterface
{

    public function sendNotification($message, $user_id,$receiver_id)
    {

                $notification = new Notification();
        $notification->message = $message;
        $notification->user_id = $user_id;
        $notification->receiver_id = $receiver_id;
//        dd($notification);
        $check = $notification->save();
//        dd($check);


        echo "Notification ! \n";

    }
}
