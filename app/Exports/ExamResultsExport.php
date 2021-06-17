<?php

namespace App\Exports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\FromArray;

class ExamResultsExport implements FromArray
{
    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
    }

    public function array(): array
    {
        $data = [['Learner Reference Number', 'Student Name', 'Score', 'Total Items']];
        $male = [['List of Males']];
        $female = [['List of Females']];
        $exam_details = $this->exam->examDetails;
        foreach ($exam_details as $exam_detail) {
            $student = $exam_detail->student;
            $exam_detail->student_name = ucwords(
                "{$student->last_name}, {$student->first_name} {$student->middle_name}"
            );
            $exam_detail->gender = $student->gender;
            $exam_detail->total_items = $exam_detail->exam->total_questions;
        }
        $exam_details_data = $exam_details->sortBy('student_name');

        foreach ($exam_details_data as $exam_detail) {
            $student = $exam_detail->student;
            $student_detail = [
                'code' => $student->code,
                'student_name' => ucwords("{$student->last_name}, {$student->first_name} {$student->middle_name}"),
                'score' => (string)$exam_detail->exam_result,
                'total_items' => (string)$exam_detail->total_items
            ];

            if ($exam_detail->gender == 'Male') {
                array_push($male, $student_detail);
            }

            if ($exam_detail->gender == 'Female') {
                array_push($female, $student_detail);
            }
        }

        if (count($male) > 1) {
            $data = array_merge($data, $male);
        }

        if (count($female) > 1) {
            $data = array_merge($data, $female);
        }

        return $data;
    }
}
