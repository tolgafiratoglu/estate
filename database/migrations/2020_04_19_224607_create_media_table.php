<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('media') == false) {
            Schema::create('media', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('name');
                $table->string('folder', 255);
                $table->integer('width');
                $table->integer('height');
                $table->string('file_type', 20);
                $table->unsignedBigInteger('user_id');
                    $table->foreign('user_id')->references('id')->on('users');
                $table->boolean('deleted')->default(false);
                $table->index(['id', 'name']);
            });
        }
    }
}
