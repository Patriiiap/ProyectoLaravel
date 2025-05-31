<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class TutorResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        $url = url(route('tutor.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    
        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->line('Recibiste este email porque solicitaste un restablecimiento de contraseña.')
            ->action('Restablecer contraseña', $url)
            ->line('Si no solicitaste el restablecimiento, no es necesario hacer nada.');
    }
}
