<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('image');
            $table->string('description');
            $table->boolean('active');
            $table->string('tagline')->nullable();
            $table->longText('charity_fb')->nullable();
            $table->longText('charity_gplus')->nullable();
            $table->longText('charity_linkedin')->nullable();
            $table->longText('charity_twitter')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charities');
    }
}
