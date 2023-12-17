<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\EmailSetting;

class ClientRegistersForTheCourse extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $template;

    /**
     * Create a new notification instance.
     *
     * @param $data
     * @param $template
     */
    public function __construct($data, $template)
    {
        $this->data = $data;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailSetting = $this->template;
        $id = $this->data->id;
        $subject = $emailSetting->subject ?? config('mail.from.name');
        $subject = str_replace('::entry_id', $id, $emailSetting->subject);
        $subject = str_replace('::id', $id, $subject);

        return $this->subject($subject)
            ->from(($emailSetting && $emailSetting->admin_email) ? $emailSetting->admin_email : config('mail.from.address'), config('mail.from.name'))
            ->cc(($emailSetting && $emailSetting->cc_email) ? explode(",", $emailSetting->cc_email) : [])
            ->bcc(($emailSetting && $emailSetting->bcc_email) ? explode(",", $emailSetting->bcc_email) : [])
            ->view('emails.client-registers-for-the-course', ['data' => $this->data, 'template' => $emailSetting]);
    }
}
