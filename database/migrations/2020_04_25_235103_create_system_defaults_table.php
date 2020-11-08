<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemDefaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('system_defaults') == false){ 
            Schema::create('system_defaults', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('context');
                $table->string('meta_key');
                $table->string('meta_value');
            });
        }
    }
}
