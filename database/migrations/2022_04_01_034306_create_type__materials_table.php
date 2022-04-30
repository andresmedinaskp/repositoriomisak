<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeMaterialsTable extends Migration
{
    
    public function up()
    {
        Schema::create('type__materials', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type__materials');
    }
}
