<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{

    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('property') == false) {
            Schema::create('property', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->unsignedBigInteger('location');
                    $table->foreign('location')->references('id')->on('location');
                $table->unsignedBigInteger('created_by');
                    $table->foreign('created_by')->references('id')->on('users');

                // $table->enum('status', ['denied', 'waiting_approval', 'approved'])->default('waiting_approval');

                $table->unsignedBigInteger('property_status');
                    $table->foreign('property_status')->references('id')->on('property_status');
                $table->unsignedBigInteger('type');
                    $table->foreign('type')->references('id')->on('property_type');    
                $table->unsignedBigInteger('featured_image')->nullable();
                    $table->foreign('featured_image')->references('id')->on('media');    
                
                $table->boolean('is_draft')->default(false);

                $table->decimal('price', 10, 2)->nullable();
                $table->text('address', 1000)->nullable();
                
                $table->integer('area');
                $table->integer('age_of_building')->default(0);
            
                $table->integer('number_of_living_rooms')->default(1);
                $table->integer('number_of_rooms')->default(0);
                $table->integer('number_of_bathrooms')->default(1);
                
                $table->integer('floor');
                $table->decimal('lat', 18, 15)->nullable()->default(null);
                $table->decimal('lon', 18, 15)->nullable()->default(null);
                
                $table->boolean('deleted')->default(false);
                
            });
        }
    }
}
