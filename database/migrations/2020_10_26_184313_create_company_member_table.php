<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('company_member') == false) {    
            Schema::create('company_member', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('company');
                    $table->foreign('company')->references('id')->on('company');
                $table->unsignedBigInteger('member');
                    $table->foreign('member')->references('id')->on('users');    
            });
        }
    }
}
