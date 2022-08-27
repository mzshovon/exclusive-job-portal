<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEducationProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_education_profiles', function (Blueprint $table) {
            $table->id();
            $table->string("subject")->nullable();
            $table->string("passing_year")->nullable();
            $table->string("cgpa")->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_education_profiles');
    }
}
