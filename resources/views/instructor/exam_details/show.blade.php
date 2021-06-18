@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> {{ ucwords($student->fullName) }} </h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item">
                <a href="{{ route('instructor.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span class="ml-2"> Dashboard </span>
                </a>
            </li>
            <li class="breadcrumb-item text-white">
                <a href="{{ route('instructor.exams') }}"> Exam Management </a>
            </li>
            <li class="breadcrumb-item text-white">
                <a href="{{ route('instructor.exams.show', $exam->id) }}">{{ ucwords($exam->code) }}</a>
            </li>
            <li class="breadcrumb-item text-white-50">Detail</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="col-md-8">
        <div class="row">
            <div class="col">
                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Student Name</dt>
                                <dd class="col-sm-9">{{ ucwords($student->fullName) }}</dd>
                                <dt class="col-sm-3">Name</dt>
                                <dd class="col-sm-9">{{ $exam->course->name }}</dd>
                                <dt class="col-sm-3">Academic Year</dt>
                                <dd class="col-sm-9">{{ $exam->course->academic_year }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-sm-3">Date Completed</dt>
                                <dd class="col-sm-9">{{ $exam_detail->date_completed }}</dd>
                                <dt class="col-sm-3">Score</dt>
                                <dd class="col-sm-9">
                                    {{ $exam_detail->exam_result }}/{{ $exam->total_questions }}
                                    @if($exam_detail->additional_points)
                                        <span class="text-success">
                                            ({{ $exam_detail->exam_score . ' + '. $exam_detail->additional_points }}pts)
                                        </span>
                                    @endif
                                </dd>
                            </dl>
                            <div>
                                <img src="{{ url('storage/student/' . $exam_detail->photo) }}" class="img-fluid"
                                     style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-body">
                            @foreach($questions as $question)
                                <div class="mb-4">
                                    <div>
                                        <p class="h2 border-bottom mb-4">
                                            Question #{{ $question->order }}
                                            @if($question->is_correct)
                                                <i class="fas fa-check ml-2 text-success"></i>
                                            @else
                                                <i class="fas fa-times ml-2 text-danger"></i>
                                            @endif
                                        </p>
                                        <p class="font-weight-500"> {{ $question->question }} </p>
                                        @if($question->referenced_file)
                                            <div class="my-4">
                                                <img src="{{ url('storage/exam/' . $question->referenced_file) }}"
                                                     class="img-fluid" style="max-height: 100px;">
                                            </div>
                                        @endif
                                    </div>
                                    @foreach($question->options as $key => $option)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check-{{ $key }}"
                                                   name="answer-{{ $key }}" value="{{ $option->id }}"
                                                   @if(in_array($option->id, $question->student_answers)) checked
                                                   @endif disabled>
                                            <label class="custom-control-label" for="check-{{ $key }}">
                                                <p>
                                                    {{ $option->option }}
                                                    @if($option->referenced_file)
                                                        —
                                                        <a href="{{ asset('/exam/' . $option->referenced_file) }}"
                                                           target="_blank">View file</a>
                                                    @endif
                                                    @if($option->is_correct)
                                                        — Correct Answer
                                                    @endif
                                                </p>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
