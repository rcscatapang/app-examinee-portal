@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> Create New Exam </h6>
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
            <li class="breadcrumb-item text-white-50">Create</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="col-md-7">
        <div class="row">
            <div class="col">
                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 font-weight-900">Exam Detail</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('instructor.exams.store') }}"
                                  role="form" id="form-data">
                                @csrf
                                <div class="form-group row mb-2">
                                    <label for="form-course" class="col-md-2 col-form-label form-control-label">
                                        Course
                                    </label>
                                    <div class="col-md-10">
                                        @if(count($courses) > 0)
                                            <select class="form-control" id="form-course" name="course_id">
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">
                                                        {{ ucwords($course->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <label class="col-form-label form-control-label">
                                                No course available ???
                                            </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="form-type" class="col-md-2 col-form-label form-control-label">
                                        Exam Type
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="form-type" name="type" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="form-link" class="col-md-2 col-form-label form-control-label">
                                        Video Meet Link
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="form-link" name="link">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="form-start-date" class="col-md-2 col-form-label form-control-label">
                                        Start Date
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="datetime-local" id="form-start-date"
                                               name="start_date" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date" class="col-md-2 col-form-label form-control-label">
                                        End Date
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="datetime-local" id="form-end-date"
                                               name="end_date" required>
                                    </div>
                                </div>
                                <div class="form-group pt-2">
                                    <label class="form-control-label" for="form-description">
                                        Exam Description
                                    </label>
                                    <textarea class="form-control" id="form-description" name="description"
                                              rows="3"></textarea>
                                </div>

                                <hr>
                                <div class="pb-4">
                                    <p class="font-weight-600 h4">Optional:</p>
                                    <span>
                                        Give additional points to students passing the exam ahead of time. Please
                                        provide how many additional points to be given at a certain minute after exam
                                        has started.
                                    </span>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="form-additional" class="col-md-2 col-form-label form-control-label">
                                        Additional Points
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="number" id="form-additional"
                                               name="additional_points">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="form-minutes" class="col-md-2 col-form-label form-control-label">
                                        In minute
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="number" id="form-finish_in_minutes"
                                               name="finish_in_minutes">
                                    </div>
                                </div>

                                @if(count($courses) > 0)
                                    <button class="btn btn-primary btn-block mt-4" type="submit">
                                        Submit
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
