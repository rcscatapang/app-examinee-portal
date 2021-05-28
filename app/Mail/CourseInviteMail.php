<?php

namespace App\Mail;

use App\Models\Course;
use App\Models\CourseInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseInviteMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $course;
    public $course_invite;

    public function __construct(Course $course, CourseInvite $course_invite)
    {
        $this->course = $course;
        $this->course_invite = $course_invite;
    }

    public function build(): CourseInviteMail
    {
        return $this->subject('Course Invitation')
            ->markdown('emails.courses.invite');
    }
}
