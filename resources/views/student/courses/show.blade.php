@extends('layouts.student.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> {{ ucwords($course->name) }} </h6>
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
    <div class="col-md-6">
        <div class="row">
            <div class="col">
                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 font-weight-900">Course Detail</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Name</dt>
                                <dd class="col-sm-9">{{ $course->name }}</dd>
                                <dt class="col-sm-3">Academic Year</dt>
                                <dd class="col-sm-9">{{ $course->academic_year }}</dd>
                                <dt class="col-sm-3">Instructor</dt>
                                <dd class="col-sm-9">{{ $instructor->full_name }} - {{ $instructor->institution }}</dd>
                            </dl>
                            <p> {{ $course->description }} </p>
                        </div>
                        @if(!$student->is_enrolled)
                            <div class="card-footer">
                                <form method="post" action="{{ route('courses.enroll') }}">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                    <button class="btn btn-primary mr-2" type="submit">Confirm Enrollment</button>
                                    <a href="{{ route('courses.join') }}">Cancel</a>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
