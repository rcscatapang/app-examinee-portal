@component('mail::message')
# Hello! <br><br>

Exam code/type: <b>{{ $exam->code }}/{{ $exam->type }}</b><br>
Examination date: <b>{{ $exam->start_date }} - {{ $exam->end_date }}</b><br>
Description: <b>{{ $exam->description }}</b>
@endcomponent
