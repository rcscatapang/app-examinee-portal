<?php

namespace App\Notifications;

use App\Mail\CourseInviteMail;
use App\Models\Course;
use App\Models\CourseInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CourseInviteNotification extends Notification
{
    use Queueable;

    private $course;
    private $course_invite;

    public function __construct(Course $course, CourseInvite $course_invite)
    {
        $this->course = $course;
        $this->course_invite = $course_invite;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): CourseInviteMail
    {
        return (new CourseInviteMail($this->course, $this->course_invite));
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
