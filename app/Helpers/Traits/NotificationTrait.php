<?php

namespace App\Helpers\Traits;

use App\Notifications\SendForgotPasswordEmailNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

trait NotificationTrait
{
    /**
     * @param $user
     * @param $token
     * @return JsonResponse|void
     */
    public function sendNotificationToUser($user, $token)
    {
        try {
            Notification::send($user, new SendForgotPasswordEmailNotification($user, $token, app()->getLocale()));
        } catch (\Exception $exception) {
            return final_response(status: $exception->getCode(), message: $exception->getMessage());
        }
    }// end of sendNotification function
}
