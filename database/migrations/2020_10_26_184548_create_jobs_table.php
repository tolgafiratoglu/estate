<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('min_salary', 10, 2)->nullable();
            $table->decimal('max_salary', 10, 2)->nullable();
            $table->unsignedBigInteger('location')->nullable();
                $table->foreign('location')->references('id')->on('company');
            $table->unsignedBigInteger('company')->nullable();
                $table->foreign('company')->references('id')->on('company');
            $table->unsignedBigInteger('created_by');
                $table->foreign('created_by')->references('id')->on('users'); 
            $table->timestamps();
        });
    }
}
