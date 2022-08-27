<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string("title_en",255)->comment("Title in English");
            $table->string("title_bn",255)->comment("Title in Bengali");
            $table->text("description_en")->comment("Description in English");
            $table->text("description_bn")->comment("Description in Bengali");
            $table->smallInteger("is_active")->default(0)->comment("If 1 will show the faq section");
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
        Schema::dropIfExists('faqs');
    }
}
