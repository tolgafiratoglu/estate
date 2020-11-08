<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('system_limits') == false)
        { 
            Schema::create('system_limits', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('context');
                $table->string('meta_key');
                $table->integer('meta_value');
            });
        }    
    }
}
