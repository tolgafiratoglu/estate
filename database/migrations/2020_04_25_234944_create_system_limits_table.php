<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_limits', function (Blueprint $table) {
            $table->string('meta_key');
            $table->integer('meta_value');
            $table->boolean('deleted')->default(false);
        });
    }
}
