<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_details', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('exam_score')->default(0);
            $table->integer('exam_result')->default(0);
            $table->timestamp('date_completed')->nullable();
            $table->integer('status');
            $table->foreignId('exam_id')->constrained('exams');
            $table->foreignId('student_id')->constrained('students');
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
        Schema::dropIfExists('exam_details');
    }
}
