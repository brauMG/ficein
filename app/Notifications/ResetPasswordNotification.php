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
            ->line('Estas recibiendo este mensaje debido a que has solicitado establecer una contraseña.')
            ->action('Generar Contraseña', url('password/reset', $this->token))
            ->line('Es necesario que presiones el botón para colocar tu nueva contraseña, asegurate de colocar el RFC correcto. El enlace dentro de este mensaje solamente es válido por 24 horas, si el tiempo de expiración ha sido superado puedes solicitar el envío de un nuevo mensaje desde el siguiente enlace: https://itfice.com/password/reset')
        ;
    }
}
