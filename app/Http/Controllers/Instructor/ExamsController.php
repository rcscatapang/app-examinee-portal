<?php

namespace App\Http\Controllers\Instructor;

use App\Enums\ExamDetailStatus;
use App\Enums\ExamStatus;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
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
        $table_headers = ['course', 'code', 'type', 'examination date', 'status', 'last updated at', ''];
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

        $action['can_update'] = false;
        $action['route'] = null;

        $students = new \stdClass();
        switch ($exam->status) {
            case ExamStatus::Draft:
                if (count($exam->questions) > 0) {
                    $action['can_update'] = true;
                    $action['name'] = 'Publish & notify students';
                    $action['route'] = route('instructor.exams.publish', $exam->id);
                }
                break;
            case ExamStatus::Published:
                $completed = $exam->examDetails->where('status', ExamDetailStatus::Submitted)->count();
                $students = $exam->course->students;

                foreach ($students as $student) {
                    $exam_detail = $student->examDetails->where('exam_id', $exam->id)->first();
                    if ($exam_detail) {
                        $student->exam_status = ExamDetailStatus::getDescription($exam_detail->status);
                        $student->exam_detail = $exam_detail;
                    } else {
                        $student->exam_status = 'Not started';
                    }
                }

                $complete_exam = Carbon::now() >= $exam->end_date;
                if (count($students) === $completed || $complete_exam) {
                    $action['can_update'] = true;
                    $action['name'] = 'Finalize & complete';
                    $action['route'] = route('instructor.exams.complete', $exam->id);
                }
                break;
            case ExamStatus::Completed:
                $students = $exam->course->students;
                foreach ($students as $student) {
                    $exam_detail = $student->examDetails->where('exam_id', $exam->id)->first();
                    if ($exam_detail) {
                        $student->exam_status = ExamDetailStatus::getDescription($exam_detail->status);
                        $student->exam_result = $exam_detail->exam_result;
                        $student->exam_detail = $exam_detail;
                    } else {
                        $student->exam_status = 'Not started';
                    }
                }
                break;
        }

        return view('instructor.exams.show', compact(['action', 'exam', 'students']));
    }

    public function setup(Exam $exam, Request $request): RedirectResponse
    {
        $input = $request->except('question', '_token');

        /* Create question referencing to exam */
        $question_detail = [
            'question' => $request['question'],
            'order' => $exam->total_questions + 1,
            'exam_id' => $exam->id
        ];
        if ($request->hasFile('reference')) {
            $request->reference->store('exam', 'public');
            $question_detail['referenced_file'] = $request->reference->hashName();
        }
        $question = Question::create($question_detail);

        foreach ($input as $key => $value) {
            if (strpos($key, 'answer') !== false) {
                $id = str_replace('answer', '', $key);
                $option = [
                    'option' => $value,
                    'is_correct' => isset($input['correct' . $id]),
                    'question_id' => $question->id
                ];
                $file = 'file' . $id;
                if ($request->hasFile($file)) {
                    $request->$file->store('exam', 'public');
                    $option['referenced_file'] = $request->$file->hashName();
                }
                Option::create($option);
            }
        }

        /* Update exam overview detail */
        $exam->total_questions = count($exam->questions);
        $exam->save();

        return redirect()->back();
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

        foreach ($exam->examDetails as $exam_detail) {
            $exam_detail->exam_result = $exam_detail->exam_score;
            $exam_detail->save();
        }

        return redirect()->route('instructor.exams.show', $exam->id);
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
        $exams = Exam::with('course')->where('instructor_id', $instructor->id);
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
