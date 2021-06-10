<?php

namespace App\Notifications;

use App\Mail\ExamScheduleMail;
use App\Models\Exam;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ExamScheduleNotification extends Notification
{
    use Queueable;

    private $exam;

    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): ExamScheduleMail
    {
        return (new ExamScheduleMail($this->exam, $notifiable))->to($notifiable->email);
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
