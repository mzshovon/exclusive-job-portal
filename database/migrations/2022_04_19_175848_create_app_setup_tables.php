<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing for packages
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('icon')->nullable();
            $table->string('color')->default("#FFF");
            $table->string('description')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });

        // Create table for storing sections
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('icon')->nullable();
            $table->string('color')->default("#FFF");
            $table->string('description')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });

        // Create table for associating sections to packages (Many-to-Many)
        Schema::create('package_sections', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('section_id');
            $table->foreign('package_id')->references("id")->on('packages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('section_id')->references("id")->on('sections')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['package_id', 'section_id']);
        });

        // Create table for storing for models
        Schema::create('models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('icon')->nullable();
            $table->string('color')->default("#FFF");
            $table->string('description')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });

        // Create table for associating models to sections (Many-to-Many)
        Schema::create('section_models', function (Blueprint $table) {
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('model_id');

            $table->foreign('model_id')->references("id")->on('models')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('section_id')->references("id")->on('sections')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['model_id', 'section_id']);
        });

        // Create table for storing for subjects
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('icon')->nullable();
            $table->string('color')->default("#FFF");
            $table->string('description')->nullable();
            $table->foreignId("created_by")->constrained("users")->onDelete("cascade");
            $table->foreignId("updated_by")->constrained("users")->onDelete("cascade");
            $table->timestamps();
        });
        
        // Create table for associating subjects to models (Many-to-Many)
        Schema::create('model_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references("id")->on('subjects')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('model_id')->references("id")->on('models')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['subject_id', 'model_id']);
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_subjects');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('section_models');
        Schema::dropIfExists('models');
        Schema::dropIfExists('package_sections');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('packages');
    }
}
