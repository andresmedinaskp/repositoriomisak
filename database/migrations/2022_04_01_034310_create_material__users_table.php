<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// tabla de Maestro detalle entre material y usuario para saber las visualizaciones y desfcargas del material
class CreateMaterialUsersTable extends Migration
{
    public function up()
    {
        Schema::create('material__users', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('manejo_users');
            $table->string('detalle_material');
            $table->dateTime('date_download');
            $table->timestamps();
            
            //llave de material
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade')->onUpdate('cascade');
            //llave de usuarios
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('material__users');
    }
}
