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
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description');
                $table->unsignedBigInteger('location');
                    $table->foreign('location')->references('id')->on('location');
                $table->unsignedBigInteger('created_by');
                    $table->foreign('created_by')->references('id')->on('users');

                $table->enum('approval_status', ['denied', 'waiting_approval', 'approved'])->default('waiting_approval');

                $table->unsignedBigInteger('property_status');
                    $table->foreign('property_status')->references('id')->on('property_status');
                $table->unsignedBigInteger('property_type');
                    $table->foreign('property_type')->references('id')->on('property_type');    
                $table->unsignedBigInteger('featured_image')->nullable();
                    $table->foreign('featured_image')->references('id')->on('media');    
                

                $table->decimal('price', 10, 2)->nullable();
                $table->text('address', 1000)->nullable();
                
                $table->integer('area');
                $table->year('year_built')->default(0);
            
                // $table->integer('number_of_living_rooms')->default(1);
                $table->integer('number_of_rooms')->default(0);
                $table->integer('number_of_bathrooms')->default(1);
                
                $table->integer('number_of_floors')->default(1);
                $table->integer('which_floor')->default(0);
                $table->decimal('lat', 18, 15)->nullable()->default(null);
                $table->decimal('lon', 18, 15)->nullable()->default(null);
                
                $table->boolean('has_garden')->default(false);
                $table->integer('area_of_garden')->nullable();

                $table->boolean('has_park_area')->default(false);
                $table->integer('number_of_park_areas')->nullable();

                // $table->boolean('is_approved')->default(false);
                $table->boolean('is_drafted')->default(false);
                $table->boolean('is_deleted')->default(false);

                // If the property will provide custom contact info other than agent profile:
                $table->boolean('is_custom_info')->default(false);
                $table->string('custom_info_name')->nullable();
                $table->string('custom_info_phone')->nullable();
                $table->string('custom_info_email')->nullable();
                
            });
        }
    }
}
