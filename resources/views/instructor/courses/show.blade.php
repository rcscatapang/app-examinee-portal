@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> {{ ucwords($course->name) }} </h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item">
                <a href="{{ route('instructor.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span class="ml-2"> Dashboard </span>
                </a>
            </li>
            <li class="breadcrumb-item text-white">
                <a href="{{ route('instructor.courses') }}"> Course Management </a>
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
                            <h3 class="mb-0 font-weight-900">Course Detail</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Name</dt>
                                <dd class="col-sm-9">{{ $course->name }}</dd>
                                <dt class="col-sm-3">Academic Year</dt>
                                <dd class="col-sm-9">{{ $course->academic_year }}</dd>
                            </dl>
                            <p> {{ $course->description }} </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 font-weight-900">Enrolled Students</h3>
                        </div>
                        <div class="card-body">
                            @forelse($students as $student)
                            @empty
                                <h4 class="font-italic font-weight-300"> No records yet — </h4>
                            @endforelse
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 font-weight-900">Invite Students</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('instructor.courses.invite', $course->id) }}"
                                  role="form" id="form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 my-auto pr-0">
                                        <input type="text" class="form-control" name="email_address"
                                               placeholder="Invite student via email address">
                                    </div>
                                    <div class="col-md-4 my-auto">
                                        <div class="d-block">
                                            <button class="btn btn-icon btn-primary" type="submit">
                                                <span class="btn-inner--icon"><i class="ni ni-email-83"></i></span>
                                                <span class="btn-inner--text">Send invite</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="pt-4 mt-4 border-top">
                                <ul class="p-0">
                                    @forelse($course_invites as $course_invite)
                                        <li class="ml-4 font-italic text-muted">
                                            {{ $course_invite->email_address }} —
                                            <a href="#">Resend invite</a>
                                        </li>
                                    @empty
                                        <h4 class="font-italic font-weight-300"> No pending invites found — </h4>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
