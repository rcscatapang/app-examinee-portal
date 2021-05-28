@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> Course Management </h6>
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
    <div class="col-md-12">
        <div class="row card-wrapper">
            <div class="col-md-3">
                <div class="card" style="min-height: 300px !important;">
                    <div class="card-body">
                        <p class="card-text mb-4">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis non dolore est fuga nobis
                            ipsum illum eligendi nemo iure repellat, soluta, optio minus ut reiciendis
                            voluptates enim impedit veritatis officiis.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('instructor.courses.create') }}" class="btn btn-md btn-primary text-white">
                            <span class="btn-inner--icon mr-2"><i class="fas fa-plus"></i></span>
                            Create New
                        </a>
                    </div>
                </div>
            </div>

            @foreach($courses as $course)
                <div class="col-md-3">
                    <div class="card" style="min-height: 300px !important;">
                        <div class="card-header border-0 pb-0">
                            <h5 class="h3 mb-0">{{ $course->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text mb-4"> {{ $course->description }} </p>
                        </div>
                        <div class="card-footer text-right py-3">
                            <a href="{{ route('instructor.courses.show', $course->id) }}">
                                <small>VIEW DETAILS <i class="fas fa-arrow-right ml-2"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
