@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> {{ ucwords($exam->code) }} </h6>
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
            <li class="breadcrumb-item text-white-50">View</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="col-md-8">
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

                    @if($exam->status === \App\Enums\ExamStatus::Draft)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0 font-weight-900">Prepare Examination</h3>
                            </div>
                            <div class="card-body">
                                <div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#questionModal">
                                        Add Question
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- TODO :: Store exam questions --}}
                {{-- Add Question Modal --}}
                <div class="modal fade" id="questionModal" tabindex="-1" role="dialog"
                     aria-labelledby="questionModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="questionModalLabel">Add Question</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            console.log('ready')
        })
    </script>
@endsection
