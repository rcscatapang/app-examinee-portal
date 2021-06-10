<?php

namespace App\Http\Controllers\Instructor;

use App\Enums\ExamStatus;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Notifications\ExamScheduleNotification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ExamsController extends Controller
{
    public function index()
    {
        $table_headers = ['code', 'type', 'examination date', 'status', 'last updated at', ''];
        return view('instructor.exams.index', compact(['table_headers']));
    }

    public function create()
    {
        $courses = Course::where('instructor_id', auth()->user()->instructor->id)->get();
        return view('instructor.exams.create', compact(['courses']));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $padded_id = Str::padLeft($input['course_id'], 3, '0');

        $input['code'] = "C{$padded_id}-" . strtoupper(Str::random(6));
        $input['instructor_id'] = auth()->user()->instructor->id;
        Exam::create($input);

        return redirect()->route('instructor.exams');
    }

    public function show(Exam $exam)
    {
        $exam->status_description = ExamStatus::getDescription($exam->status);
        switch ($exam->status) {
            case ExamStatus::Draft:
                $action['can_update'] = true;
                $action['name'] = 'Publish & notify students';
                $action['route'] = route('instructor.exams.publish', $exam->id);
                break;
            case ExamStatus::Published:
                $action['can_update'] = true;
                $action['name'] = 'Finalize & complete';
                $action['route'] = route('instructor.exams.complete', $exam->id);
                break;
            default:
                $action['can_update'] = false;
                $action['route'] = null;
                break;
        }

        return view('instructor.exams.show', compact(['action', 'exam']));
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function complete(Exam $exam): RedirectResponse
    {
        $exam->status = ExamStatus::Completed;
        $exam->completed_date = Carbon::now();
        $exam->save();

        return redirect()->route('admin.instructors.exams');
    }

    public function publish(Exam $exam): RedirectResponse
    {
        $exam->status = ExamStatus::Published;
        $exam->published_date = Carbon::now();
        $exam->save();

        $students = $exam->course->students;
        foreach ($students as $student) {
            $student->user->notify(new ExamScheduleNotification($exam));
        }

        return redirect()->route('instructor.exams');
    }

    public function getDataTable(): JsonResponse
    {
        $instructor = auth()->user()->instructor;
        $exams = Exam::where('instructor_id', $instructor->id);
        return DataTables::eloquent($exams)
            ->addColumn(
                'action_column',
                function ($exam) {
                    $route = route('instructor.exams.show', ['exam' => $exam->id]);
                    return '<a href="' . $route . '" class="table-action"><i class="fas fa-chevron-right"></i></a>';
                }
            )->rawColumns(['action_column'])
            ->toJson();
    }
}
