<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('media');
                    $table->foreign('media')->references('id')->on('media');
            $table->unsignedBigInteger('property');
                    $table->foreign('property')->references('id')->on('property');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_media');
    }
}
