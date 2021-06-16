@component('mail::message')
# Greetings! <br><br>

<p>You have a new scheduled exam. Please see the details below.</p><br>

Exam type/code: <b>{{ $exam->type }}/{{ $exam->code }}</b><br>
Examination date: <b>{{ $exam->start_date }} - {{ $exam->end_date }}</b><br>
Description: <b>{{ $exam->description }}</b>
@endcomponent
