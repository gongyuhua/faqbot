<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Answer;

class QuestionAnswered extends Mailable
{
    use Queueable, SerializesModels;

    public $Answer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Answer $Answer)
    {
        $this->Answer = $Answer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.questions.answered');
    }
}