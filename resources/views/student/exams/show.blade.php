@extends('layouts.student.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> {{ $exam->code }} </h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span class="ml-2"> Dashboard </span>
                </a>
            </li>
            <li class="breadcrumb-item text-white">
                <a href="{{ route('exams') }}"> Examinations </a>
            </li>
            <li class="breadcrumb-item text-white-50">View</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="col-md-9">
        <div class="row">
            <div class="col">
                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 font-weight-900">Exam Detail</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Course</dt>
                                <dd class="col-sm-9">{{ $course->name }} - {{ $course->academic_year }}</dd>
                                <dt class="col-sm-3">Instructor</dt>
                                <dd class="col-sm-9">
                                    {{ $course->instructor->full_name }} - {{ $course->instructor->institution }}
                                </dd>
                            </dl>

                            <dl class="row">
                                <dt class="col-sm-3">Exam Type / Code</dt>
                                <dd class="col-sm-9">{{ $exam->type }} / {{ $exam->code }}</dd>
                                <dt class="col-sm-3">Examination Date</dt>
                                <dd class="col-sm-9">{{ $exam->start_date }} - {{ $exam->end_date }}</dd>
                                <dt class="col-sm-3">Video Meet Link</dt>
                                <dd class="col-sm-9">
                                    @if($exam->link)
                                        <a href="{{ $exam->link }}" target="_blank"> {{ $exam->link }} </a>
                                    @else
                                        —
                                    @endif
                                </dd>
                                @if(isset($exam_detail))
                                    <dt class="col-sm-3">Submitted Date</dt>
                                    <dd class="col-sm-9">{{ $exam_detail->date_completed }}</dd>
                                @endif
                                @if($exam->status === \App\Enums\ExamStatus::Completed)
                                    <dt class="col-sm-3">Completed Date</dt>
                                    <dd class="col-sm-9">{{ $exam->completed_date }}</dd>
                                    <dt class="col-sm-3">Exam Result</dt>
                                    <dd class="col-sm-9">
                                        {{ $exam_detail->exam_result }}/{{ $exam->total_questions }}
                                    </dd>
                                @endif
                            </dl>
                            <p> {{ $exam->description }} </p>

                            @if(isset($exam_detail))
                                @if($exam_detail->status === \App\Enums\ExamDetailStatus::Submitted && $exam->status === \App\Enums\ExamStatus::Published)
                                    <p class="font-weight-500 font-italic text-warning">
                                        Pending for checking & completion — Please wait for further updates
                                    </p>
                                @endif
                            @endif
                        </div>
                        @if($exam->status === \App\Enums\ExamStatus::Completed)
                            <div class="card-footer">
                                <a href="{{ route('examDetails.show', $exam_detail->id) }}"
                                   class="btn btn-icon btn-primary">
                                    View Results
                                </a>
                            </div>
                        @endif
                        @if($action['can_update'])
                            <div class="card-footer">
                                <form method="post" action="{{ $action['route'] }}" role="form" id="form-data"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @if(!isset($exam_detail))
                                        <div class="py-4">
                                            <p class="mb-2">
                                                Donec consectetur, mauris at commodo viverra, risus nunc commodo augue,
                                                sit amet cursus arcu tellus id erat. Aliquam ac varius turpis. Praesent
                                                nunc arcu, posuere in semper vitae, sodales vestibulum dolor.
                                            </p>
                                            <div class="form-group w-50">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="form-reference"
                                                           lang="en" name="reference" accept="image/png, image/jpeg"
                                                           required>
                                                    <label class="custom-file-label" for="form-reference"></label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <button class="btn btn-icon btn-primary" type="submit">
                                        <span class="btn-inner--icon"><i class="fas fa-check"></i></span>
                                        <span class="btn-inner--text">{{ $action['name'] }}</span>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
