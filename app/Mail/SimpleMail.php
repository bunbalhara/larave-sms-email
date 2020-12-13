<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class SimpleMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $fromAddress;
    public $subject;
    public $content;
    public $toAddress;

    public function __construct($fromAddress, $subject, $content, $toAddress)
    {
        $this->fromAddress = $fromAddress;
        $this->content = $content;
        $this->subject = $subject;
        $this->toAddress = $toAddress;
    }

    public function build()
    {
        $sender = $this->fromAddress;
        $token = Crypt::encryptString($this->toAddress);

        return $this->from($this->fromAddress)
            ->subject($this->subject)
            ->view('admin.messages.mail.simple-mail')
            ->with([
                'content'=>$this->content,
                'sender'=>$sender,
                'token'=>$token
            ]);
    }

    public function failed()
    {
        // Called when the job is failing...
        Log::alert('error in queue mail');

    }
}
