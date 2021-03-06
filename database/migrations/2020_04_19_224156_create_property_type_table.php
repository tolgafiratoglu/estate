<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('property_type') == false) {
            Schema::create('property_type', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('title');
                $table->string('slug')->unique()->nullable();
                $table->boolean('deleted')->default(false);
            });
        }
    }
}
