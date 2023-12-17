<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\EmailSetting;

class ContactSendMail extends Mailable
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
        $emailSetting = EmailSetting::whereType(EmailSetting::TYPE_VERLETVERGOEDING)->first();

        return $this->subject($emailSetting->subject ?? config('mail.from.name'))
            ->from(($emailSetting && $emailSetting->admin_email) ? $emailSetting->admin_email : config('mail.from.address'), config('mail.from.name'))
            ->cc(($emailSetting && $emailSetting->cc_email) ? explode(",", $emailSetting->cc_email) : [])
            ->bcc(($emailSetting && $emailSetting->bcc_email) ? explode(",", $emailSetting->bcc_email) : [])
            ->view('emails.client-registers-for-the-course', ['data' => $this->data, 'template' => $emailSetting]);
    }
}
