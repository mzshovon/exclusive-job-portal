<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_sets_package', function (Blueprint $table) {
            $table->unsignedBigInteger('model_sets_id');
            $table->unsignedBigInteger('package_id');
            $table->foreign('model_sets_id')->references("id")->on('models')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('package_id')->references("id")->on('packages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['model_sets_id', 'package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_package');
    }
}
