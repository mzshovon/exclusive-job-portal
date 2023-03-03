<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string("title_en",400)->comment("Title in English");
            $table->string("title_bn",400)->comment("Title in Bengali")->nullable();
            $table->longText("description_en")->comment("Description in English");
            $table->longText("description_bn")->comment("Description in Bengali")->nullable();
            $table->smallInteger("is_active")->default(0)->comment("If 1 will show the about us section");
            $table->smallInteger("type")->nullable(false)->comment("1= About us, 2= About Exams, 3= About Rules");
            $table->string("image_path",255)->nullable(false)->comment("Store the base path of images");
            $table->string("image_position",122)->nullable(false)->comment("Store image position of the section");
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->ipAddress("ip_address");
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
        Schema::dropIfExists('abouts');
    }
}
