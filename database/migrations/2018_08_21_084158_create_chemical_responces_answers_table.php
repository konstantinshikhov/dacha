<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChemicalResponcesAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chemical_responces_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('response_id');
            $table->integer('user_id');
            $table->integer('profile_id');
            $table->text('response');
            $table->date('date');
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
        Schema::dropIfExists('chemical_responces_answers');
    }
}
