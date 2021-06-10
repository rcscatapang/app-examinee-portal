@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> Exam Management </h6>
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
        <div class="card-wrapper">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-900">Exam - Data List</h3>
                </div>
                <div class="table-responsive py-3">
                    <table class="table table-flush table-hover" id="datatable-list" width="100%">
                        <thead class="thead-light">
                        <tr>
                            @foreach ($table_headers as $header)
                                <th> {{ strtoupper($header) }} </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        {{-- Render data list from DataTables --}}
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-2">
                    <a href="{{ route('instructor.exams.create') }}" class="btn btn-md btn-primary text-white">
                        <span class="btn-inner--icon mr-2"><i class="fas fa-plus"></i></span>
                        Create New
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
