<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortQuestionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sort_questionaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('general_info_id');
            $table->integer('sort_id');
            $table->integer('generation');
            $table->integer('landing_area');
            $table->date('seeding_date');
            $table->string('cultivation_type');
            $table->date('ground_transplantation_date');
            $table->date('trimming_date');
            $table->boolean('is_ill');
            $table->boolean('artificial_irrigation');
            $table->boolean('drip_irrigation');
            $table->integer('precipitation_from_planting');
            $table->integer('feeding_from_planting');
            $table->integer('artificial_irrigation_from_planting');
            $table->integer('harvest');
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
        Schema::dropIfExists('sort_questionaries');
    }
}
