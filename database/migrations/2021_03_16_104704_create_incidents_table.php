<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('severity',1); // A= Alto | N=Normal | M=Menor 
            $table->boolean('active')->default(1); // 1= Pendiente ó asignado | 0= Resuelto 


            $table->unsignedBigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            
            $table->unsignedBigInteger('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
            
            $table->unsignedBigInteger('level_id')->unsigned()->nullable();
            $table->foreign('level_id')->references('id')->on('levels');
            
            $table->unsignedBigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('support_id')->unsigned()->nullable();
            $table->foreign('support_id')->references('id')->on('users');

            $table->string('accion')->nullable();
            $table->date('accion_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidents');
    }
}
