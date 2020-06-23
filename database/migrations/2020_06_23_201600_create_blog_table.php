<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(Schema::hasTable('blog') == false) {
            Schema::create('blog', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('title');
                $table->string('slug');
                $table->text('content');
                $table->unsignedBigInteger('created_by');
                    $table->foreign('created_by')->references('id')->on('users');

                $table->boolean('is_approved')->default(false);
                $table->boolean('is_drafted')->default(false);
                $table->boolean('is_deleted')->default(false);

            });
        }    
    }
}
