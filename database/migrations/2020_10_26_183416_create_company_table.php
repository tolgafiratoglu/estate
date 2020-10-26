<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('company') == false) {    
            Schema::create('company', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title', 255);
                $table->unsignedBigInteger('admin');
                    $table->foreign('admin')->references('id')->on('users');
                $table->boolean('deleted')->default(false);
                $table->unsignedBigInteger('logo')->nullable();
                    $table->foreign('logo')->references('id')->on('media');
                $table->timestamps();
            });
        }
    }
}
