<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyInteriorFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('property_exterior_feature') == false) {
            Schema::create('property_interior_feature', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('property');
                    $table->foreign('property')->references('id')->on('property');
                $table->unsignedBigInteger('interior_feature');
                    $table->foreign('interior_feature')->references('id')->on('interior_feature');
            });
        }    
    }
}
