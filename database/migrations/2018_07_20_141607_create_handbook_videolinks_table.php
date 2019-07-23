<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandbookVideolinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handbook_videolinks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->string('link', 200);
            $table->integer('user_id');
            $table->string('moderator', 10);
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
        Schema::dropIfExists('handbook_videolinks');
    }
}
