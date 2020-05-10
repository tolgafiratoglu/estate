<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemDefaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_defaults', function (Blueprint $table) {
            $table->string('meta_key');
            $table->string('meta_value');
            $table->boolean('deleted')->default(false);
        });
    }
}
