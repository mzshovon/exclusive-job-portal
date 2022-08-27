<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableExams extends Migration
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
            $table->unsignedBigInteger('type')->nullable(false);
            $table->string('color')->default("#FFF");
            $table->string('description')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
                
        // Create table for associating exams to questions (Many-to-Many)
        Schema::create('exam_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references("id")->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('exam_id')->references("id")->on('exams')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['subject_id', 'exam_id']);
        });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_exams');
    }
}
