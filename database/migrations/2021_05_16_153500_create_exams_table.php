<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('type');
            $table->string('link');
            $table->text('description');
            $table->integer('total_questions')->default(0);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('finish_in_minutes')->nullable();
            $table->integer('additional_points')->nullable();
            $table->timestamp('published_date')->nullable();
            $table->timestamp('completed_date')->nullable();
            $table->integer('status')->default(\App\Enums\ExamStatus::Draft);
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('instructor_id')->constrained('instructors');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
