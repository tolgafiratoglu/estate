<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyExteriorFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('property_exterior_feature_table') == false) {
            Schema::create('property_exterior_feature_table', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('property');
                    $table->foreign('property')->references('id')->on('property');
                $table->unsignedBigInteger('exterior_feature');
                    $table->foreign('exterior_feature')->references('id')->on('exterior_feature');
            });
        }    
    }
}
