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
    <div class="col-md-9">
        <div class="row">
            <div class="col">
                <div class="card-wrapper">
                    <div class="card">
                        <form method="post" action="{{ $exam->id }}">
                            <div class="card-body">
                                Lorem ipsum
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-icon btn-primary" type="submit">
                                    <span class="btn-inner--icon"><i class="fas fa-check"></i></span>
                                    <span class="btn-inner--text">Next</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
