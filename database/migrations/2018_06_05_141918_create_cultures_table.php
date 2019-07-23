<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCulturesTable extends Migration
{
    public function up()
    {
        Schema::create('cultures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('section_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cultures');
    }
}
