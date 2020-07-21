<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('property_view') == false) {
            Schema::create('property_view', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('property');
                    $table->foreign('property')->references('id')->on('property');
                $table->unsignedBigInteger('view');
                    $table->foreign('view')->references('id')->on('view');
            });
        }    
    }
}
