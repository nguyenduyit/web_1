<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;
use Illuminate\Routing\UrlGenerator;

class DisagreeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $student,$url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student,$url)
    {
        //
        $this->student=$student;
        $this->url=$url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Thông báo ")
        ->view('mail.disagree');
    }
}
