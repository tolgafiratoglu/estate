<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('system_media') == false){ 
            Schema::create('system_media', function (Blueprint $table) {
                $table->string('meta_key');
                $table->unsignedBigInteger('media')->nullable();
                    $table->foreign('media')->references('id')->on('media');
            });
        }
    }
}
