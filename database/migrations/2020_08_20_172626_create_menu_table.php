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
                $table->enum('context', ['header','menu', 'footer'])->default('header');
                $table->string("label", 100);
                $table->enum('target', ['blank','self', 'parent', 'top'])->default('self');
                $table->text("custom_url")->nullable()->default(null);
                $table->unsignedBigInteger('parent')->nullable()->default(null);
                    $table->foreign('parent')->references('id')->on('menu')->onDelete('SET NULL');
                $table->unsignedBigInteger('property')->nullable()->default(null);
                    $table->foreign('property')->references('id')->on('property');
                $table->unsignedBigInteger('blog')->nullable()->default(null);
                    $table->foreign('blog')->references('id')->on('blog'); 
            });
        }

    }
}
