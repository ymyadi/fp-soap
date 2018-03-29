<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailPegawaiBaru extends Mailable
{
    use Queueable, SerializesModels;
    protected $contentMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contentMail)
    {
        $this->contentMail = $contentMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.pegawai.akunBaru')
                        ->with('content', $this->contentMail);
    }
}
