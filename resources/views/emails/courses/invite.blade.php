@component('mail::message')
# Greetings and welcome aboard!<br><br>

You've been invited to join <b>{{ $course->name }}</b>. To accept this request you'll need a registered account at hala.com.
Please use the following email address and invite code: <br>

Email Address: <b>{{ $course_invite->email_address }}</b> <br>
Invite Code: <b>{{ $course_invite->invite_code }}</b>

@component('mail::button', ['url' => config('app.url')])
Get Started
@endcomponent
@endcomponent
