<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuizAttemptReport extends Mailable
{
    use Queueable, SerializesModels;

    public $quiz;
    public $attempts;

    public function __construct($quiz, $attempts)
    {
        $this->quiz = $quiz;
        $this->attempts = $attempts;
    }

    public function build()
    {
        return $this->subject('Daily Quiz Attempt Report')
            ->view('mail');
    }
}
