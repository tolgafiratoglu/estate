<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('location') == false) {
            Schema::create('location', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('name');
                $table->string('slug')->unique()->nullable();
                $table->text('description')->nullable();
                $table->unsignedBigInteger('parent')->nullable()->default(null);
                    $table->foreign('parent')->references('id')->on('location')->onDelete('set null');
                $table->boolean('deleted')->default(false);
            });
        }
    }
}
