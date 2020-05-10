<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('news') == false) {    
            Schema::create('news', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title', 255);
                $table->text('content', 1000);
                $table->unsignedBigInteger('created_by');
                    $table->foreign('created_by')->references('id')->on('users');
                $table->boolean('deleted')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
