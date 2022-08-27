<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsAndAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->longText("description")->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(false);
            $table->integer("is_answer")->default(0);
            $table->longText("description")->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
        Schema::create('question_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            $table->foreign('answer_id')->references("id")->on('answers')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_id')->references("id")->on('questions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['answer_id', 'question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');
    }
}
