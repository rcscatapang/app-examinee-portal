<?php

namespace App\Http\Controllers\Student;

use App\Enums\ExamDetailStatus;
use App\Enums\ExamStatus;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamDetail;
use App\Models\Question;
use App\Traits\ManagesQuotes;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamsController extends Controller
{
    use ManagesQuotes;

    public function index()
    {
        $student = auth()->user()->student;
        $courses = $student->courses->pluck('id');

        $current_date = Carbon::now();
        $upcoming_exams = Exam::whereIn('course_id', $courses)->where('status', ExamStatus::Published)
            ->whereDate('start_date', '>', $current_date)->orderBy('start_date', 'desc')->get();
        $ongoing_exams = Exam::whereIn('course_id', $courses)->where('status', ExamStatus::Published)
            ->whereDate('start_date', '<=', $current_date)->orderBy('start_date', 'desc')->get();

        return view('student.exams.index', compact(['upcoming_exams', 'ongoing_exams']));
    }

    public function show(Exam $exam)
    {
        $exam->status_description = ExamStatus::getDescription($exam->status);
        switch ($exam->status) {
            case ExamStatus::Published:
                $action['can_update'] = true;
                $action['name'] = 'Start Exam';
                $action['route'] = route('exams.start', [$exam->id]);
                break;
            default:
                $action['can_update'] = false;
                $action['route'] = null;
                break;
        }
        return view('student.exams.show', compact(['action', 'exam']));
    }

    public function start(Exam $exam): RedirectResponse
    {
        $student = auth()->user()->student;
        $exam_detail = ExamDetail::where('exam_id', $exam->id)
            ->where('student_id', $student->id)->first();

        if (!$exam_detail) {
            $exam_detail = [
                'code' => "$exam->code-" . Str::padLeft($student->id, 3, '0'),
                'status' => ExamDetailStatus::Pending,
                'exam_id' => $exam->id,
                'student_id' => $student->id
            ];
            $exam_detail = ExamDetail::create($exam_detail);
        }

        $question = $exam->questions->first();
        return redirect()->route('exams.answer', [$exam_detail->id]);
    }

    public function answer(ExamDetail $exam_detail, Question $question)
    {
        $exam = $exam_detail->exam;
        $quote = $this->getQuote();

        $action['next'] = route('exams.submit', [$exam->id]);
        return view('student.exams.question', compact(['action', 'exam', 'exam_detail', 'quote']));
    }

    public function submit(ExamDetail $exam_detail, Question $question, Request $request): RedirectResponse
    {
        return redirect()->route('exams.answer', [$exam_detail->id]);
    }

    public function complete(ExamDetail $exam_detail)
    {
        $exam = $exam_detail->exam;
        return view('student.exams.show', compact(['exam']));
    }
}
