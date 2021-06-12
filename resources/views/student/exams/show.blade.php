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
                                <dt class="col-sm-3">Exam Type / Code</dt>
                                <dd class="col-sm-9">{{ $exam->type }} / {{ $exam->code }}</dd>
                                <dt class="col-sm-3">Examination Date</dt>
                                <dd class="col-sm-9">{{ $exam->start_date }} - {{ $exam->end_date }}</dd>
                                <dt class="col-sm-3">Status</dt>
                                <dd class="col-sm-9">{{ $exam->status_description }}</dd>
                                @if($exam->status === \App\Enums\ExamStatus::Published)
                                    <dt class="col-sm-3">Published Date</dt>
                                    <dd class="col-sm-9">{{ $exam->published_date }}</dd>
                                @endif
                                @if($exam->status === \App\Enums\ExamStatus::Completed)
                                    <dt class="col-sm-3">Completed Date</dt>
                                    <dd class="col-sm-9">{{ $exam->completed_date }}</dd>
                                @endif
                            </dl>
                            <p> {{ $exam->description }} </p>
                        </div>
                        @if($action['can_update'])
                            <div class="card-footer">
                                <form method="post" action="{{ $action['route'] }}" role="form" id="form-data">
                                    @csrf
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
