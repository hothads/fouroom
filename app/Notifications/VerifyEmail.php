<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyEmail extends VerifyEmailBase
{
//    use Queueable;


    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return (new MailMessage)
            ->subject(Lang::get('Подтвердите ваш адрес'))
            ->line(Lang::get('Пожалуйста, подтвердите ваш email адрес.'))
            ->action(Lang::get('Подтвердить'), $verificationUrl)
            ->line(Lang::get('Если это письмо пришло к вам по ошибке, никаких действий не требуется'));
    }
}