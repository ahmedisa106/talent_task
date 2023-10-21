<?php

namespace App\Notifications;

use App\Mail\ForgotPassword;
use App\Mail\SendForgotPasswordEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendForgotPasswordEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $token;
    public $locale;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $token, $locale = null)
    {
        //
        $this->user = $user;
        $this->token = $token;
        $this->locale = $locale;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())->markdown('auth/forgot_password', ['user' => $this->user, 'token' => $this->token,"url"=>"http://wwww.localhost:8000"]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
