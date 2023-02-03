<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_exam', function (Blueprint $table) {
            $table->unsignedBigInteger('chapter_id');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('chapter_id')->references("id")->on('chapters')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('exam_id')->references("id")->on('exams')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['chapter_id', 'exam_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapter_exam');
    }
}
