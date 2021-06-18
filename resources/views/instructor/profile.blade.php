@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> Profile </h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item">
                <a href="{{ route('instructor.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span class="ml-2"> Dashboard </span>
                </a>
            </li>
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
                            <h3 class="mb-0 font-weight-900">Your Profile</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <dl class="row">
                                        <dt class="col-sm-4">First Name</dt>
                                        <dd class="col-sm-8">{{ ucwords($instructor->first_name) ?? '—' }}</dd>
                                        <dt class="col-sm-4">Last Name</dt>
                                        <dd class="col-sm-8">{{ ucwords($instructor->last_name) ?? '—' }}</dd>
                                        <dt class="col-sm-4">Middle Name</dt>
                                        <dd class="col-sm-8">{{ $instructor->middle_name ?? '—' }}</dd>
                                        <dt class="col-sm-4">Institution</dt>
                                        <dd class="col-sm-8">{{ $instructor->institution ?? '—' }}</dd>
                                        <dt class="col-sm-4">Contact Number</dt>
                                        <dd class="col-sm-8">{{ $instructor->contact_number ?? '—' }}</dd>
                                        <dt class="col-sm-4">Email</dt>
                                        <dd class="col-sm-8">{{ $instructor->email ?? '—' }}</dd>
                                        <dt class="col-sm-4">Birthday</dt>
                                        <dd class="col-sm-8">{{ $instructor->birthday ?? '—' }}</dd>
                                        <dt class="col-sm-4">Gender</dt>
                                        <dd class="col-sm-8">{{ $instructor->gender ?? '—' }}</dd>
                                    </dl>
                                </div>
                                <div class="col-md-3">
                                    <span class="avatar avatar-xl rounded-circle mb-4">
                                        @if($instructor->photo)
                                            <img src="{{ url('storage/user/' . $instructor->photo) }}">
                                        @else
                                            <i class="fas fa-2x fa-user"></i>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

