<?php

use App\Http\Controllers\Instructor;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication routes
Auth::routes(['verify' => true]);
Route::get('onboarding', [\App\Http\Controllers\Auth\OnboardingController::class, 'onboarding'])->name('onboarding');
Route::post('onboarding', [\App\Http\Controllers\Auth\OnboardingController::class, 'complete'])->name('onboarding.complete');

Route::name('instructor.')->prefix('instructor')->middleware(['web.instructor'])->group(function () {
    // Pages
    Route::get('dashboard', Instructor\DashboardController::class)->name('dashboard');
    Route::get('profile', [Instructor\UsersController::class, 'profile'])->name('profile');

    // Course management
    Route::get('courses', [Instructor\CoursesController::class, 'index'])->name('courses');
    Route::post('courses', [Instructor\CoursesController::class, 'store'])->name('courses.store');
    Route::get('courses/create', [Instructor\CoursesController::class, 'create'])->name('courses.create');
    Route::get('courses/{course}', [Instructor\CoursesController::class, 'show'])->name('courses.show');
    Route::get('courses/{course}/edit', [Instructor\CoursesController::class, 'edit'])->name('courses.edit');
    Route::post('courses/{course}/update', [Instructor\CoursesController::class, 'update'])->name('courses.update');
    Route::post('courses/{course}/invite', [Instructor\CoursesController::class, 'invite'])->name('courses.invite');

    // Students management
    Route::get('students', [Instructor\StudentsController::class, 'index'])->name('students');
    Route::get('students/{student}', [Instructor\StudentsController::class, 'show'])->name('students.show');

    // Exam management
    Route::get('exams', [Instructor\ExamsController::class, 'index'])->name('exams');
    Route::post('exams', [Instructor\ExamsController::class, 'store'])->name('exams.store');
    Route::get('exams/create', [Instructor\ExamsController::class, 'create'])->name('exams.create');
    Route::get('exams/{exam}', [Instructor\ExamsController::class, 'show'])->name('exams.show');
    Route::post('exams/{exam}/complete', [Instructor\ExamsController::class, 'complete'])->name('exams.complete');
    Route::post('exams/{exam}/publish', [Instructor\ExamsController::class, 'publish'])->name('exams.publish');
    Route::post('exams/{exam}/create/setup', [Instructor\ExamsController::class, 'setup'])->name('exams.setup');
    Route::post('exams/{exam}/delete/setup/{question}', [Instructor\ExamsController::class, 'delete'])->name('exams.delete');
    Route::get('exams/{exam}/export', [Instructor\ExamsController::class, 'export'])->name('exams.export');

    Route::get('exams/{exam_detail}/detail', [Instructor\ExamDetailsController::class, 'show'])->name('examDetails.show');

    // DataTables management
    Route::get('data-tables/exams', [Instructor\ExamsController::class, 'getDataTable'])->name('dataTable.exams');
    Route::get('data-tables/students', [Instructor\StudentsController::class, 'getDataTable'])->name('dataTable.students');
});

Route::middleware(['web.student'])->group(function () {
    // Pages
    Route::get('', function () { return redirect(route('dashboard')); });
    Route::get('dashboard', Student\DashboardController::class)->name('dashboard');
    Route::get('profile', [Student\UsersController::class, 'profile'])->name('profile');

    // Courses
    Route::get('join-courses', [Student\CoursesController::class, 'join'])->name('courses.join');
    Route::post('join-courses/search', [Student\CoursesController::class, 'search'])->name('courses.search');
    Route::post('join-courses/enroll', [Student\CoursesController::class, 'enroll'])->name('courses.enroll');
    Route::get('courses/{course}', [Student\CoursesController::class, 'show'])->name('courses.show');

    // Examinations
    Route::get('exams', [Student\ExamsController::class, 'index'])->name('exams');
    Route::get('exams/{exam}', [Student\ExamsController::class, 'show'])->name('exams.show');
    Route::post('exams/{exam}/start', [Student\ExamsController::class, 'start'])->name('exams.start');
    Route::get('exams/{exam_detail}/answer/{question}', [Student\ExamsController::class, 'answer'])->name('exams.answer');
    Route::post('exams/{exam_detail}/submit', [Student\ExamsController::class, 'submit'])->name('exams.submit');
    Route::post('exams/{exam_detail}/complete', [Student\ExamsController::class, 'complete'])->name('exams.complete');

    Route::get('exams/{exam_detail}/detail', [Student\ExamDetailsController::class, 'show'])->name('examDetails.show');
});
