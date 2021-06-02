@extends('layouts.student.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> Enroll to Course </h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span class="ml-2"> Dashboard </span>
                </a>
            </li>
            <li class="breadcrumb-item text-white-50">Enroll to Course</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="col-md-6">
        <div class="row">
            <div class="col">
                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('courses.search') }}" id="form">
                                @csrf
                                <div class="form-group mb-2">
                                    <p class="mb-4">
                                        Pellentesque rutrum lorem in dui tristique pharetra.
                                        Etiam vulputate erat placerat magna ullamcorper, vel tempus risus accumsan.
                                        Please contact your instructor if you have not recieved an invitation.
                                    </p>
                                    <label class="form-control-label" for="invite_code">
                                        Please enter invite code
                                    </label>
                                    <input type="text" class="form-control" id="invite_code" name="invite_code">
                                </div>

                                <button class="btn btn-primary" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
