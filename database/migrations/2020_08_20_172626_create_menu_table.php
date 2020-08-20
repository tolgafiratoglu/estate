<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if(Schema::hasTable('menu') == false) {
            Schema::create('menu', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string("context", 10);
                $table->string("label", 100);
                $table->string("target", 10);
                $table->text("custom_url");
                $table->unsignedBigInteger('parent')->nullable()->default(null);
                    $table->foreign('menu')->references('id')->on('menu');
                $table->unsignedBigInteger('property')->nullable()->default(null);
                    $table->foreign('property')->references('id')->on('property');
                $table->unsignedBigInteger('blog')->nullable()->default(null);
                    $table->foreign('blog')->references('id')->on('blog'); 
            });
        }

    }
}
