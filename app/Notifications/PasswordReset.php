<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Http\Utilties\CommonUtils;


class PasswordReset extends Notification
{
    use Queueable;
/**
 * The password reset token.
 *
 * @var string
 */
public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $message_data['subject'] = 'Reset Password';
        $message_data['email'] = $notifiable['email'];
        $message_data['name'] = $notifiable['name'];
        $message_data['token'] = $this->token;

        $send_email = CommonUtils::sendEmail('emails.email_password_resset', $message_data);
        
        if($send_email){
            return true;
        }
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
