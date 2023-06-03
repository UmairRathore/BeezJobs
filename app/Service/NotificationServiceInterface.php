<?php

namespace App\Service;

interface NotificationServiceInterface
{
    public function sendNotification($message,$user_id,$receiver_id);
}
