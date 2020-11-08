<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('system_settings') == false) {
            Schema::create('system_settings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('context');
                $table->string('meta_key');
                $table->boolean('meta_value');
            });
        }
    }
}
