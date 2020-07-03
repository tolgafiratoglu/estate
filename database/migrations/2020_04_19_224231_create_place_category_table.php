<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('place_category') == false) {
            Schema::create('place_category', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('title');
            });
        }
    }
}
