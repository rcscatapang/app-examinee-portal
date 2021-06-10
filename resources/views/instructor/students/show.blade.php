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
                <a href="{{ route('instructor.students') }}"> Student Management </a>
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
                            <h3 class="mb-0 font-weight-900">Student Detail</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">First Name</dt>
                                <dd class="col-sm-9">{{ ucwords($student->first_name) ?? '—' }}</dd>
                                <dt class="col-sm-3">Last Name</dt>
                                <dd class="col-sm-9">{{ ucwords($student->last_name) ?? '—' }}</dd>
                                <dt class="col-sm-3">Middle Name</dt>
                                <dd class="col-sm-9">{{ ucwords($student->middle_name) ?? '—' }}</dd>
                                <dt class="col-sm-3">Contact Number</dt>
                                <dd class="col-sm-9">{{ $student->contact_number ?? '—' }}</dd>
                                <dt class="col-sm-3">Email</dt>
                                <dd class="col-sm-9">{{ $student->email ?? '—' }}</dd>
                                <dt class="col-sm-3">Birthday</dt>
                                <dd class="col-sm-9">{{ $student->birthday ?? '—' }}</dd>
                                <dt class="col-sm-3">Gender</dt>
                                <dd class="col-sm-9">{{ $student->gender ?? '—' }}</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 font-weight-900">Enrolled Courses</h3>
                        </div>
                        <div class="card-body">
                            @forelse($student_courses as $course)
                                <li class="ml-4">
                                    <a href="{{ route('instructor.courses.show', $course->id) }}" class="text-muted">
                                        {{ ucwords($course->name) }}
                                    </a>
                                </li>
                            @empty
                                <h4 class="font-italic font-weight-300"> No records yet — </h4>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
