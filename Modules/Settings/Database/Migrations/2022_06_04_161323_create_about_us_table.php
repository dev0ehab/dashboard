<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('about_us_title')->nullable();
            $table->string('about_us_sub_title')->nullable();
            $table->text('about_us_desc')->nullable();
            $table->text('our_vision')->nullable();
            $table->text('our_mission')->nullable();
            $table->text('our_tasks')->nullable();
            $table->text('address')->nullable();
            $table->string('map_address1')->nullable();
            $table->string('longitude1')->nullable()->default('31.233334');
            $table->string('latitude1')->nullable()->default('30.033333');
            $table->string('map_address2')->nullable();
            $table->string('longitude2')->nullable()->default('31.233334');
            $table->string('latitude2')->nullable()->default('30.033333');
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
        Schema::dropIfExists('about_us');
    }
}
