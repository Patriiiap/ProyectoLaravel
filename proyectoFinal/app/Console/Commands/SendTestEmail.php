<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Send a test email to check Mailtrap setup';

    public function handle()
    {
        $toEmail = 'tu-email@example.com'; // Cambia aquí a tu email o cualquiera que uses para probar

        Mail::raw('Este es un correo de prueba para verificar Mailtrap.', function ($message) use ($toEmail) {
            $message->to($toEmail)
                    ->subject('Correo de prueba Mailtrap');
        });

        $this->info('Email enviado, revisa Mailtrap inbox.');
    }
}
