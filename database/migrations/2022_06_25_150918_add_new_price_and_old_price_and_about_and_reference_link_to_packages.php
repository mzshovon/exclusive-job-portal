<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewPriceAndOldPriceAndAboutAndReferenceLinkToPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('about',255)->nullable();
            $table->decimal('new_price',$precision = 8, $scale = 2)->default(0);
            $table->decimal('old_price',$precision = 8, $scale = 2)->default(0);
            $table->string('reference_link',255)->nullable();
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
