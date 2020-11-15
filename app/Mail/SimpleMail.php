<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SimpleMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $fromAddress;
    public $subject;
    public $content;

    public function __construct($fromAddress, $subject, $content)
    {
        $this->fromAddress = $fromAddress;
        $this->content = $content;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->from($this->fromAddress)
            ->subject($this->subject)
            ->view('admin.messages.mail.simple-mail')
            ->with(['content'=>$this->content]);
    }

    public function failed()
    {
        // Called when the job is failing...
        Log::alert('error in queue mail');

    }
}
