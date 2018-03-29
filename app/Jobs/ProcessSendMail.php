<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailPegawaiBaru;

class ProcessSendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $contentMail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contentMail)
    {
        $this->contentMail = $contentMail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->contentMail['type_mail'] == 'pegawai_baru'):
            $driver = new MailPegawaiBaru($this->contentMail);
        endif;
        Mail::to($this->contentMail['to'])->queue($driver);
    }
}
