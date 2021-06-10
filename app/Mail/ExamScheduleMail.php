<?php

namespace App\Mail;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExamScheduleMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $exam;
    public $user;

    public function __construct(Exam $exam, User $user)
    {
        $this->exam = $exam;
        $this->user = $user;
    }

    public function build(): ExamScheduleMail
    {
        return $this->markdown('emails.exams.schedule');
    }
}
