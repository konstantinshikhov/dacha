<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->text('description');
            $table->string('main_photo');
            $table->integer('category_id');
            $table->integer('culture_id');
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
        Schema::dropIfExists('handbooks');
    }
}
