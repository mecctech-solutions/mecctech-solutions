<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Mailable $mailable;

    private string $recipientEmailAddress;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Mailable $mailable,
        string $recipientEmailAddress)
    {
        $this->mailable = $mailable;
        $this->recipientEmailAddress = $recipientEmailAddress;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->recipientEmailAddress)->send($this->mailable);
    }
}
