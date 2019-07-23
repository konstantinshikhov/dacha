<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SectionsAddImageAndSlug extends Migration
{
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
        });
    }
}
