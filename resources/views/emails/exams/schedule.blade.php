@component('mail::message')
# Hello! <br><br>

Exam type/code: <b>{{ $exam->type }}/{{ $exam->code }}</b><br>
Examination date: <b>{{ $exam->start_date }} - {{ $exam->end_date }}</b><br>
Description: <b>{{ $exam->description }}</b>
@endcomponent
