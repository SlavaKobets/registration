<?php

namespace App\Notifications;

use App\Channels\SMSChannel;
use App\Channels\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUserSMSNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return [SMSChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return SmsMessage
     */
    public function toSms($notifiable): SmsMessage
    {
        return (new SmsMessage)
                    ->phone($notifiable->phone)
                    ->message('Congratulations! You are successfully registered!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
