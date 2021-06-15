@extends('layouts.student.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> Examinations </h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span class="ml-2"> Dashboard </span>
                </a>
            </li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="col-md-9">
        <div class="row">
            <div class="col">
                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-2 font-weight-900">Upcoming</h3>
                            <ul class="list-group list-group-flush list">
                                @if(count($upcoming_exams) > 0)
                                    @foreach($upcoming_exams as $exam)
                                        <li class="list-group-item px-0 border-top">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>
                                                <div class="col">
                                                    <a href="{{ route('exams.show', $exam->id) }}">
                                                        <small>{{ $exam->code }} - {{ $exam->type }}</small>
                                                    </a>
                                                    <h5 class="mb-0">{{ $exam->course->name }}</h5>
                                                </div>
                                                <div class="col">
                                                    <small>Start date:</small>
                                                    <h5 class="mb-0">{{ $exam->start_date }}</h5>
                                                </div>
                                                <div class="col">
                                                    <small>End date:</small>
                                                    <h5 class="mb-0">{{ $exam->end_date }}</h5>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="border-top">
                                        <h4 class="font-italic font-weight-300 pt-2"> No records yet — </h4>
                                    </div>
                                @endif
                            </ul>

                            <h3 class="mb-2 mt-4 font-weight-900">Ongoing</h3>
                            <ul class="list-group list-group-flush list">
                                @if(count($ongoing_exams) > 0)
                                    @foreach($ongoing_exams as $exam)
                                        <li class="list-group-item px-0 border-top">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-pen"></i>
                                                </div>
                                                <div class="col">
                                                    <a href="{{ route('exams.show', $exam->id) }}">
                                                        <small>{{ $exam->code }} - {{ $exam->type }}</small>
                                                    </a>
                                                    <h5 class="mb-0">{{ $exam->course->name }}</h5>
                                                </div>
                                                <div class="col">
                                                    <small>Start date:</small>
                                                    <h5 class="mb-0">{{ $exam->start_date }}</h5>
                                                </div>
                                                <div class="col">
                                                    <small>End date:</small>
                                                    <h5 class="mb-0">{{ $exam->end_date }}</h5>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="border-top">
                                        <h4 class="font-italic font-weight-300 pt-2"> No records yet — </h4>
                                    </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="mb-2 font-weight-900">Completed</h3>
                            <ul class="list-group list-group-flush list">
                                @if(count($completed_exams) > 0)
                                    @foreach($completed_exams as $exam)
                                        <li class="list-group-item px-0 border-top">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="col">
                                                    <a href="{{ route('exams.show', $exam->id) }}">
                                                        <small>{{ $exam->code }} - {{ $exam->type }}</small>
                                                    </a>
                                                    <h5 class="mb-0">{{ $exam->course->name }}</h5>
                                                </div>
                                                <div class="col">
                                                    <small>Start date:</small>
                                                    <h5 class="mb-0">{{ $exam->start_date }}</h5>
                                                </div>
                                                <div class="col">
                                                    <small>End date:</small>
                                                    <h5 class="mb-0">{{ $exam->end_date }}</h5>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="border-top">
                                        <h4 class="font-italic font-weight-300 pt-2"> No records yet — </h4>
                                    </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
