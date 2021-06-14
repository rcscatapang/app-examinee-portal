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
            <li class="breadcrumb-item text-white-50">Take Exam</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="col-md-8">
        <div class="row">
            <div class="col select-none">
                <div class="card-wrapper">
                    <div class="card">
                        <form method="post"
                              action="@if($can_complete) {{ $action['complete'] }} @else {{ $action['next'] }} @endif">
                            @csrf
                            <div class="card-body user-select-none p-5">
                                <input type="hidden" name="question_id" id="question_id" value="{{ $question->id }}">
                                <div>
                                    <div>
                                        <p class="h2 border-bottom mb-4">
                                            Question #{{ $question->order }} of {{ $exam->total_questions }}
                                        </p>
                                        <p class="font-weight-500"> {{ $question->question }} </p>
                                    </div>
                                    @foreach($question->options as $key => $option)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="check-{{ $key }}"
                                                   name="answer-{{ $key }}" value="{{ $option->id }}">
                                            <label class="custom-control-label" for="check-{{ $key }}">
                                                <p>{{ $option->option }}</p>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer">
                                @if($can_complete)
                                    <button class="btn btn-icon float-right btn-success" type="submit">
                                        <span class="btn-inner--icon"><i class="fas fa-check"></i></span>
                                        <span class="btn-inner--text">Complete & submit</span>
                                    </button>
                                @else
                                    <button class="btn btn-icon float-right btn-primary" type="submit">
                                        <span class="btn-inner--icon"><i class="fas fa-check"></i></span>
                                        <span class="btn-inner--text">Next</span>
                                    </button>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="text-center px-7">
                        <i class="fas fa-quote-left"></i>
                        <span class="mx-2 h2">{{ $quote }}</span>
                        <i class="fas fa-quote-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
    <style>
        .select-none {
            -webkit-user-select: none; /* Safari */
            -ms-user-select: none; /* IE 10 and IE 11 */
            user-select: none; /* Standard syntax */
        }
    </style>
@stop
