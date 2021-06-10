<?php

use App\Http\Controllers\Instructor;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Landing pages
Route::get('/', function () { return view('welcome'); });

// Authentication routes
Auth::routes(['verify' => true]);
Route::get('onboarding', [\App\Http\Controllers\Auth\OnboardingController::class, 'onboarding'])->name('onboarding');
Route::post('onboarding', [\App\Http\Controllers\Auth\OnboardingController::class, 'complete'])->name('onboarding.complete');

Route::name('instructor.')->prefix('instructor')->middleware(['web.instructor'])->group(function () {

    // Dashboard
    Route::get('dashboard', Instructor\DashboardController::class)->name('dashboard');

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
    Route::get('exams/{exam}/edit', [Instructor\ExamsController::class, 'edit'])->name('exams.edit');
    Route::post('exams/{exam}/update', [Instructor\ExamsController::class, 'update'])->name('exams.update');
    Route::post('exams/{exam}/complete', [Instructor\ExamsController::class, 'complete'])->name('exams.complete');
    Route::post('exams/{exam}/publish', [Instructor\ExamsController::class, 'publish'])->name('exams.publish');

    // DataTables management
    Route::get('data-tables/exams', [Instructor\ExamsController::class, 'getDataTable'])->name('dataTable.exams');
    Route::get('data-tables/students', [Instructor\StudentsController::class, 'getDataTable'])->name('dataTable.students');
});

Route::middleware(['web.student'])->group(function () {

    // Dashboard
    Route::get('dashboard', Student\DashboardController::class)->name('dashboard');

    // Course management
    Route::get('join-courses', [Student\CoursesController::class, 'join'])->name('courses.join');
    Route::post('join-courses/search', [Student\CoursesController::class, 'search'])->name('courses.search');
    Route::post('join-courses/enroll', [Student\CoursesController::class, 'enroll'])->name('courses.enroll');
    Route::get('courses/{course}', [Student\CoursesController::class, 'show'])->name('courses.show');
});
