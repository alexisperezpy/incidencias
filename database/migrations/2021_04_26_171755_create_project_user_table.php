<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUserTable extends Migration
{
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_user');
    }
}
