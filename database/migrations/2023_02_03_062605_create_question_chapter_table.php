<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_chapter', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('chapter_id');
            $table->foreign('question_id')->references("id")->on('questions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('chapter_id')->references("id")->on('chapters')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['question_id', 'chapter_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_chapter');
    }
}
