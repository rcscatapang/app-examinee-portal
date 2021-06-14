<?php

namespace App\Http\Controllers\Student;

use App\Enums\ExamDetailStatus;
use App\Enums\ExamStatus;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamDetail;
use App\Models\Question;
use App\Models\StudentAnswer;
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

        $question = $exam->questions()->orderBy('order')->first();
        return redirect()->route('exams.answer', [$exam_detail->id, $question->id]);
    }

    public function answer(ExamDetail $exam_detail, Question $question)
    {
        $exam = $exam_detail->exam;
        $quote = $this->getQuote();

        $can_complete = $question->order === $exam->total_questions;
        $action['name'] = 'Submit & complete examination';
        $action['next'] = route('exams.submit', [$exam_detail->id]);
        $action['complete'] = route('exams.complete', [$exam_detail->id]);

        return view(
            'student.exams.question',
            compact(['action', 'can_complete', 'exam', 'exam_detail', 'question', 'quote'])
        );
    }

    public function submit(ExamDetail $exam_detail, Request $request): RedirectResponse
    {
        $input = $request->except('_token', 'question_id');
        $this->saveStudentAnswer($input, $exam_detail->id, $request['question_id']);
        $this->computeExamScore($exam_detail);

        $question_order = Question::find($request['question_id'])->order;
        $question = $exam_detail->exam->questions()->where('order', $question_order + 1)->first();
        return redirect()->route('exams.answer', [$exam_detail->id, $question->id]);
    }

    protected function saveStudentAnswer($input, $exam_detail_id, $question_id): bool
    {
        foreach ($input as $key => $value) {
            if (strpos($key, 'answer') !== false) {
                StudentAnswer::where('exam_detail_id', $exam_detail_id)->where('question_id', $question_id)->delete();
                $student_answer = [
                    'exam_detail_id' => $exam_detail_id,
                    'question_id' => $question_id,
                    'option_id' => $value
                ];
                StudentAnswer::create($student_answer);
            }
        }

        return true;
    }

    protected function computeExamScore($exam_detail): bool
    {
        $exam_questions = $exam_detail->exam->questions;
        $score = 0;
        foreach ($exam_questions as $exam_question) {
            $correct_answers = $exam_question->options()->where('is_correct', true)->pluck('id')->toArray();
            $student_answers = StudentAnswer::where('exam_detail_id', $exam_detail->id)
                ->where('question_id', $exam_question->id)->pluck('option_id')->toArray();
            $diff = array_diff($correct_answers, $student_answers);
            if (count($diff) == 0) {
                $score++;
            }
        }

        $exam_detail->exam_score = $this->computeExamScore($exam_detail);
        $exam_detail->save();

        return true;
    }

    public function previous(ExamDetail $exam_detail, Request $request): RedirectResponse
    {
        $input = $request->except('_token', 'question_id');
        $this->saveStudentAnswer($input, $exam_detail->id, $request['question_id']);
        $this->computeExamScore($exam_detail);

        $question_order = Question::find($request['question_id'])->order;
        if (($question_order - 1) != 0) {
            $question = $exam_detail->exam->questions()->where('order', $question_order - 1)->first();
            return redirect()->route('exams.answer', [$exam_detail->id, $question->id]);
        }

        return redirect()->route('exams.show', $exam_detail->exam->id);
    }

    public function complete(ExamDetail $exam_detail, Request $request): RedirectResponse
    {
        $input = $request->except('_token', 'question_id');
        $this->saveStudentAnswer($input, $exam_detail->id, $request['question_id']);
        $this->computeExamScore($exam_detail);

        $exam_detail->date_completed = Carbon::now();
        $exam_detail->status = ExamDetailStatus::Submitted;
        $exam_detail->save();

        return redirect()->route('exams.show', $exam_detail->exam->id);
    }
}
