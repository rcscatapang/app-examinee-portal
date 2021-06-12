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
                <a href="{{ route('instructor.exams') }}"> Exam Management </a>
            </li>
            <li class="breadcrumb-item text-white">
                <a href="{{ route('instructor.exams.show', $exam->id) }}">{{ ucwords($exam->code) }}</a>
            </li>
            <li class="breadcrumb-item text-white-50">Detail</li>
        </ol>
    </nav>
@stop
