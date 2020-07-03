<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('place') == false) {
            Schema::create('place', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->unsignedBigInteger('place_category')->nullable()->default(null);
                    $table->foreign('place_category')->references('id')->on('place_category');
                $table->string('title');
                $table->decimal('lat', 18, 15)->nullable()->default(null);
                $table->decimal('lon', 18, 15)->nullable()->default(null);
            });
        }
    }
}
