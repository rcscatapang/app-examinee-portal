@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> Create New Course </h6>
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
            <li class="breadcrumb-item text-white-50">Create</li>
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
                            <h3 class="mb-0 font-weight-900">Course Detail</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('instructor.courses.store') }}"
                                  role="form" id="form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="form-name" class="col-md-2 col-form-label form-control-label">
                                        Course Name
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="form-name" name="name" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="form-academic-year" class="col-md-2 col-form-label form-control-label">
                                        Academic Year
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="form-academic-year"
                                               name="academic_year">
                                    </div>
                                </div>

                                <div class="form-group pt-2">
                                    <label class="form-control-label" for="form-description">
                                        Class Description
                                    </label>
                                    <textarea class="form-control" id="form-description" name="description" required
                                              rows="3"></textarea>
                                </div>

                                <button class="btn btn-primary btn-block mt-4" type="submit">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
