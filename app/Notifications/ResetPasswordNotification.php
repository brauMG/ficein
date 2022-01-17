<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword implements ShouldQueue
{
    use Queueable;

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
        return (new MailMessage)
            ->subject('Ficein - Genera tu contraseña de acceso')
            ->line('Estas recibiendo este mensaje debido a que tu cuenta ha sido registrada en nuestro sistema.')
            ->action('Generar Contraseña', url('password/reset', $this->token))
            ->line('Es necesario que presiones el botón para generar una contraseña de acceso. El enlace dentro de este mensaje solamente es válido por 24 horas, si el tiempo de expiración ha sido superado puedes solicitar el envío de un nuevo mensaje desde el siguiente enlace: https://ficein.local/password/reset');
    }
}
