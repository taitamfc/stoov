<?php

namespace App\Jobs;

use App\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSendMail;
use Exception;
use App\Course;
use Carbon\Carbon;

class ContactSendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Calculate the number of seconds to wait before retrying the job.
     *
     * @return array
     */
    public function backoff()
    {
        return 300;
    }

    /**
     * Create a new job instance.
     *
     * @param $data
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $course = $this->data;
        Mail::to($course->client->email)->send(new ContactSendMail($course));

        Client::whereId($course->client->id)->update([
            'year_sent'   => Carbon::now()->format('Y')
        ]);
    }

    /**
     * Failed the job.
     *
     * @param Exception $exception
     *
     * @return void
     */
    public function failed(Exception $exception)
    {
        $course = $this->data;
        Client::whereId($course->client->id)->update([
            'year_sent'   => null
        ]);
    }
}
