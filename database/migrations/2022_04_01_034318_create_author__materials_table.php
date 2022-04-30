<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//ralaciona autores con materiales tabla de Maestro detalle
class CreateAuthorMaterialsTable extends Migration
{
    public function up()
    {
        Schema::create('author__materials', function (Blueprint $table) {
            $table->id()->unique();

            //llave de material
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');
            
            //llave de autor 
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('author__materials');
    }
}
