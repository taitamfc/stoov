<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;
    protected $token;
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
        return (new MailMessage)
        ->line('Uw inloggegevens voor de portal van STOOV.')
        ->line('Geachte heer/mevrouw,')
        ->line('U kunt inloggen op fondsstoov.nl met de volgende gegevens.')
        ->action('Wachtwoord opnieuw instellen', url('password/reset', $this->token))
        ->line('Heeft u vragen? Neem dan contact op met STOOV via fondsstoov.nl')
        ->line('Met vriendelijke groet,')
        ->line('Cor Wittekoek')
        ->line('STOOV')
        ->line('Dit is een automatisch gegenereerd e-mailbericht.');
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
