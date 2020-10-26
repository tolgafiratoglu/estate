<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExteriorFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('exterior_feature') == false) {
            Schema::create('exterior_feature', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('title');
                $table->boolean('deleted')->default(false);
            });
        }
    }
}
