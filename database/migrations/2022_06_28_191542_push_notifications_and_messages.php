<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PushNotificationsAndMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing for push_notifications
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject')->unique();
            $table->string('code')->nullable();
            $table->unsignedBigInteger('status')->default(0);
            $table->unsignedBigInteger('token_used')->default(0);
            $table->unsignedBigInteger('success_rate')->default(100);
            $table->string('language',50)->default('bn');
            $table->string('duration')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
        // Create table for storing for messages
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject')->unique();
            $table->string('code')->nullable();
            $table->unsignedBigInteger('status')->default(0);
            // $table->unsignedBigInteger('token_used')->default(0);
            $table->string('language',50)->default('bn');
            $table->string('duration')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });

        // Create table for associating users to notifications (Many-to-Many)
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('push_notification_id');
            $table->foreign('user_id')->references("id")->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('push_notification_id')->references("id")->on('push_notifications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'push_notification_id']);
        });
        // Create table for associating users to messages (Many-to-Many)
        Schema::create('user_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('message_id');
            $table->foreign('user_id')->references("id")->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('message_id')->references("id")->on('messages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'message_id']);
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
