<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GegevensWijzigenSendMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['emailadres'])
            ->from($this->data['emailadres'])
            ->view('emails.gegevens_wijzigens', ['data' => $this->data]);
    }
}
