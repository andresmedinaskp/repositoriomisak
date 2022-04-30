<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name');
            $table->string('isbn');
            $table->year('year');
            $table->integer('num_pages');
            $table->integer('priority');
            $table->string('pdf');
            $table->string('img');

            // llave para asiganarle un tipo de material  
            $table->unsignedBigInteger('type_material_id');
            $table->foreign('type_material_id')->references('id')->on('type__materials')->onDelete('cascade')->onUpdate('cascade');

            // llave para asiganarle una editorial
            $table->unsignedBigInteger('editorial_id');
            $table->foreign('editorial_id')->references('id')->on('editorials')->onDelete('cascade')->onUpdate('cascade');

            // llave para asiganarle un area
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
