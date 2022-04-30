<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// tabla de Maestro detalle 
class CreateMaterialEducationalLevelsTable extends Migration
{
    public function up()
    {
        Schema::create('material__educational_levels', function (Blueprint $table) {
            $table->id()->unique();
            $table->timestamps();

            //llave de material
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');

            //llave de nivel de educacion
            $table->unsignedBigInteger('educational_level_id');
            $table->foreign('educational_level_id')->references('id')->on('educational_levels')->onDelete('cascade')->onUpdate('cascade');

       
        });
    }
    public function down()
    {
        Schema::dropIfExists('material__educational_levels');
    }
}
