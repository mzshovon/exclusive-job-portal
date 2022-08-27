<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModelQuestionsAndSubjectQuestionsAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating subjects to questions (Many-to-Many)
        Schema::create('subject_questions', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('question_id');
            $table->foreign('subject_id')->references("id")->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_id')->references("id")->on('questions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['subject_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
