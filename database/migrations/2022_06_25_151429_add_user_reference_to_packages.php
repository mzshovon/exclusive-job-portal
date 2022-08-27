<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserReferenceToPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating users to packages (Many-to-Many)
        Schema::create('package_users', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('package_id')->references("id")->on('packages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references("id")->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['package_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
}
