@extends('layouts.instructor.app')

@section('header_left')
    <h6 class="h2 text-white d-inline-block mb-0"> {{ ucwords($exam->code) }} </h6>
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
                            <h3 class="mb-0 font-weight-900">Exam Detail</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Exam Type / Code</dt>
                                <dd class="col-sm-9">{{ $exam->type }} / {{ $exam->code }}</dd>
                                <dt class="col-sm-3">Examination Date</dt>
                                <dd class="col-sm-9">{{ $exam->start_date }} - {{ $exam->end_date }}</dd>
                                <dt class="col-sm-3">Status</dt>
                                <dd class="col-sm-9">{{ $exam->status_description }}</dd>
                                @if($exam->status === \App\Enums\ExamStatus::Published)
                                    <dt class="col-sm-3">Published Date</dt>
                                    <dd class="col-sm-9">{{ $exam->published_date }}</dd>
                                @endif
                                @if($exam->status === \App\Enums\ExamStatus::Completed)
                                    <dt class="col-sm-3">Completed Date</dt>
                                    <dd class="col-sm-9">{{ $exam->completed_date }}</dd>
                                @endif
                            </dl>
                            <p> {{ $exam->description }} </p>
                        </div>
                        @if($action['can_update'])
                            <div class="card-footer">
                                <form method="post" action="{{ $action['route'] }}" role="form" id="form-data">
                                    @csrf
                                    <button class="btn btn-icon btn-primary" type="submit">
                                        <span class="btn-inner--icon"><i class="fas fa-check"></i></span>
                                        <span class="btn-inner--text">{{ $action['name'] }}</span>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    @if($exam->status === \App\Enums\ExamStatus::Draft)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0 font-weight-900">Setup Exam Items</h3>
                            </div>
                            <div class="card-body">
                                <div>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#questionModal">
                                        <span class="btn-inner--icon mr-2"><i class="fas fa-plus"></i></span>
                                        <span class="btn-inner--text">Question</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($exam->status === \App\Enums\ExamStatus::Published)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0 font-weight-900">Manage Students</h3>
                            </div>
                            <div class="card-body">
                                @foreach($students as $student)
                                    <li class="ml-4">
                                        <span>{{ $student->code }} - {{ ucwords($student->full_name) }} - </span>
                                        @if(!isset($student->exam_detail))
                                            <span class="font-italic text-muted">{{ $student->exam_status }}</span>
                                        @else
                                            <a href="{{ route('instructor.examDetails.show', $student->exam_detail->id) }}"
                                               class="text-body">
                                                <span class="font-italic text-muted">{{ $student->exam_status }}</span>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Question Modal --}}
                <div class="modal fade" id="questionModal" tabindex="-1" role="dialog"
                     aria-labelledby="questionModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="questionModalLabel">Add Question</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="{{ route('instructor.exams.setup', $exam->id) }}"
                                  id="answer-form" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label class="form-control-label" for="form-question">Question*</label>
                                        <textarea class="form-control" id="form-question" name="question" required
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Reference file</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="form-reference" lang="en"
                                                   name="reference" accept="image/png, image/jpeg">
                                            <label class="custom-file-label" for="form-reference"></label>
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="button" value="Add answer" class="add btn btn-icon btn-secondary"
                                           id="add"/>
                                    <div id="answers-section" class="pt-4"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#add").click(function () {
                let lastField = $("#answers-section div:last")
                let intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1
                let fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>")
                fieldWrapper.data("idx", intId)
                let fCorrect = $("<span class=\"fieldtype custom-control custom-checkbox d-inline\"> <input type=\"checkbox\" class=\"custom-control-input\" id=\"check" + intId + "\" name=\"correct" + intId + "\"/> <label class=\"custom-control-label\" for=\"check" + intId + "\"></label></span>")
                let fAnswer = $("<input type=\"text\" class=\"fieldname form-control w-50 d-inline form-control-sm\" name=\"answer" + intId + "\" required/>")
                let fFile = $("<input type=\"file\" class=\"fieldfile custom-file-input ml-2 w-25 d-inline form-control-sm\" name=\"file" + intId + "\"/>")
                let removeButton = $("<input type=\"button\" class=\"remove btn btn-secondary btn-sm mb-2\" value=\"x\"/>")
                removeButton.click(function () {
                    $(this).parent().remove()
                });
                fieldWrapper.append(fCorrect)
                fieldWrapper.append(fAnswer)
                fieldWrapper.append(fFile)
                fieldWrapper.append(removeButton)
                $("#answers-section").append(fieldWrapper)
            })
        })
    </script>
@endsection
