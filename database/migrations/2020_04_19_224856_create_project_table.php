<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('project') == false) {
            Schema::create('project', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('title');
                $table->string('slug');
                $table->unsignedBigInteger('location');
                    $table->foreign('location')->references('id')->on('location');
                $table->unsignedBigInteger('created_by');
                    $table->foreign('created_by')->references('id')->on('users');
                $table->unsignedBigInteger('featured_image')->nullable();
                    $table->foreign('featured_image')->references('id')->on('media');    

                $table->date('estimated_completion_date');
                $table->boolean('on_sale');
                $table->date('estimated_date_for_sale')->nullable();

                $table->integer('number_of_properties')->default(1);

                $table->integer('min_number_of_rooms')->default(1);
                $table->integer('max_number_of_rooms')->default(1);

                $table->decimal('min_price')->default(0);
                $table->decimal('max_price')->default(1);
                
                $table->decimal('lat', 18, 15)->nullable()->default(null);
                $table->decimal('lon', 18, 15)->nullable()->default(null);
                
                $table->boolean('is_approved')->default(false);
                $table->boolean('is_drafted')->default(false);
                $table->boolean('is_deleted')->default(false);
                
            });
        }
    }
}
