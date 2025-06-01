<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class AdminResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('admin.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject(Lang::get('Notificación de restablecimiento de contraseña'))
            ->line(Lang::get('Has solicitado restablecer tu contraseña.'))
            ->action(Lang::get('Restablecer contraseña'), $url)
            ->line(Lang::get('Si no solicitaste este cambio, ignora este mensaje.'));
    }
}
