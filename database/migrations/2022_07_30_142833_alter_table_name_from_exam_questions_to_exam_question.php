<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableNameFromExamQuestionsToExamQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('exam_questions','exam_question');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // For drop
    }
}
