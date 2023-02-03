<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment')->nullable(false);
            $table->integer('seen')->default(0);
            $table->string('other')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
        Schema::create('replys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reply')->nullable(false);
            $table->string('other')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
        Schema::create('reply_comment', function (Blueprint $table) {
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('reply_id');
            $table->foreign('comment_id')->references("id")->on('comments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reply_id')->references("id")->on('replys')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['comment_id', 'reply_id']);
        });
        Schema::create('comment_question', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('comment_id');
            $table->foreign('question_id')->references("id")->on('questions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('comment_id')->references("id")->on('comments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['question_id','comment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_reply');
    }
}
