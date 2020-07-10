<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoolingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('cooling') == false){     
            
            Schema::create('cooling', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->timestamps();
            });

            Schema::table('property', function($table)
            {
                $table->unsignedBigInteger('cooling')->nullable();
                    $table->foreign('cooling')->references('id')->on('cooling');  
            });

        }
    }
}
