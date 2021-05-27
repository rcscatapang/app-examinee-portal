<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseInviteMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $course;
    private $email_address;
    private $name;

    public function __construct(Course $course, $name, $email_address)
    {
        $this->course = $course;
        $this->name = $name;
        $this->email_address = $email_address;
    }

    public function build(): CourseInviteMail
    {
        return $this->subject('Course Invitation')
            ->markdown('emails.courses.invite');
    }
}
