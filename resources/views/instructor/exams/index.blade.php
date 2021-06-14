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

@section('styles')
    @include('shared.data_tables_css')
@stop

@section('scripts')
    @include('shared.data_tables_js')
    <script>
        var DatatableList = (function () {
            var $dtList = $('#datatable-list')

            function init($this) {
                var ajax_url = "{{ route('instructor.dataTable.exams') }}"
                var buttons = ["copy", "csv"];
                var options = {
                    bDestroy: true,
                    bAutoWidth: true,
                    processing: true,
                    serverSide: true,
                    lengthChange: true,
                    pageLength: 10,
                    buttons: buttons,
                    language: {
                        paginate: {
                            previous: "<i class='fas fa-angle-left'>",
                            next: "<i class='fas fa-angle-right'>"
                        }
                    },
                    ajax: {
                        "url": ajax_url,
                        "dataType": "json",
                        "type": "GET",
                        "data": {_token: "{{ csrf_token() }}"}
                    },
                    order: ['2', 'desc'],
                    columns: [
                        {data: 'course.name', name: 'course.name', orderable: false},
                        {data: 'code', name: 'code'},
                        {data: 'type', name: 'type'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'status', name: 'status', orderable: false},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'action_column', name: 'action_column', orderable: false, searchable: false},
                    ],
                }
                var table = $this.on('init.dt', function () {
                    $('div.dataTables_length select').removeClass('custom-select custom-select-sm');
                }).DataTable(options)
            }

            if ($dtList.length) {
                init($dtList);
            }
        })()
    </script>
@stop
