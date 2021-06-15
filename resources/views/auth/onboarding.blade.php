@extends('layouts.default.app')

@section('header')
    <div class="header-body text-center mb-4">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                <h1 class="text-white">Welcome!</h1>
                <p class="text-lead text-white">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id dictum tellus.
                    Nullam fermentum facilisis neque id aliquet.
                </p>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card-header bg-transparent">
                    <div class="text-muted text-center mx-4 mt-3">
                        <h3 class="mb-0">User Registration Form</h3>
                        <small>Fill out the form carefully to complete registration</small>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('onboarding.complete') }}" id="form" role="form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="user_type" value="{{ $user->user_type }}">

                        @if($user->user_type === \App\Enums\UserType::Student)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="form-code">
                                            Learner Reference Number
                                        </label>
                                        <input type="text" class="form-control" id="form-code" name="code">
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($user->user_type === \App\Enums\UserType::Instructor)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="form-institution">
                                            Institution
                                        </label>
                                        <input type="text" class="form-control" id="form-institution"
                                               name="institution">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form-first-name">First Name</label>
                                    <input type="text" class="form-control" id="form-first-name" name="first_name"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form-last-name">Last Name</label>
                                    <input type="text" class="form-control" id="form-last-name" name="last_name"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form-middle-name">Middle Name</label>
                                    <input type="text" class="form-control" id="form-middle-name" name="middle_name"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-control-label" for="form-contact-number">Contact Number</label>
                                    <input type="text" class="form-control" id="form-contact-number"
                                           name="contact_number"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-control-label" for="form-email-address">Email Address</label>
                                    <input type="email" class="form-control" id="form-email-address" name="email"
                                           value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form-birthday">Birthday</label>
                                    <input class="form-control" type="date" id="form-birthday" name="birthday">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form-gender">Gender</label>
                                    <select class="form-control" id="form-gender" name="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label class="form-control-label">Upload Account Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="form-photo" lang="en" required
                                           name="file" accept="image/png, image/jpeg">
                                    <label class="custom-file-label" for="form-photo"></label>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <button type="submit" class="btn btn-primary px-5">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
