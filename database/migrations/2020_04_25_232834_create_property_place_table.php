<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_place_table', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property');
                $table->foreign('property')->references('id')->on('property');
            $table->unsignedBigInteger('place');
                $table->foreign('place')->references('id')->on('place');
        });
    }
}
