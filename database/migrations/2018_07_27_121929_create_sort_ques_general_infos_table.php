<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortQuesGeneralInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sort_ques_general_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('region', 200);
            $table->string('locality', 200);
            $table->string('soil', 200);
            $table->integer('high');
            $table->integer('precipitation');
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
        Schema::dropIfExists('sort_ques_general_infos');
    }
}
