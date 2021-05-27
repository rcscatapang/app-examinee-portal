<?php

namespace App\Notifications;

use App\Mail\CourseInviteMail;
use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CourseInviteNotification extends Notification
{
    use Queueable;

    private $course;
    private $email_address;
    private $name;

    public function __construct(Course $course, $email_address, $name)
    {
        $this->course = $course;
        $this->email_address = $email_address;
        $this->name = $name;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): CourseInviteMail
    {
        return (new CourseInviteMail($this->course, $this->name, $this->email_address));
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
