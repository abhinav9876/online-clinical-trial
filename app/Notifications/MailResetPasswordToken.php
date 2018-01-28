<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class MailResetPasswordToken extends ResetPassword
{

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('passwordの再setting')
            ->line('ログインアカウントのpassword再settingのリクエストを受け付けましたので、このメールをお送りしております。')
            ->action('passwordを再settingTo', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('こちらのメールに心当たりがない場合は、このままDeleteいただきますようにお願い致します。');
    }
}
