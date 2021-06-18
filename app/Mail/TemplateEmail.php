<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemplateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject, $title, $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $email_subject, String $email_title, String $email_body)
    {
        $this->subject = $email_subject;
        $this->title = $email_title;
        $this->body = $email_body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.emailTemplate', [
                        'title' => $this->title,
                        'body' => $this->body,
                        ])
                    ->subject($this->subject);
    }
}
