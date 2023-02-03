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
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('icon')->nullable();
            $table->string('color')->default("#FFF")->nullable();
            $table->string('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('exam_type')->comment("1=Online Test, 2= IQ Test")->nullable(false);
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });

        // Create table for associating subjects to exams (Many-to-Many)
        Schema::create('exam_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references("id")->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('exam_id')->references("id")->on('exams')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['subject_id', 'exam_id']);
        });
        // Create table for associating questions to exams (Many-to-Many)
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references("id")->on('questions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('exam_id')->references("id")->on('exams')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['question_id', 'exam_id']);
        });
        // Create table for associating questions to exams (Many-to-Many)
        Schema::create('user_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('exam_id')->references("id")->on('exams')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references("id")->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'exam_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            //
        });
    }
}
