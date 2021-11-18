<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->integer('charity_id');
            $table->integer('user_id');
            $table->string('title');
            $table->longText('image')->nullable();;
            $table->string('description')->nullable();
            $table->decimal('actual_target', 8, 2);
            $table->decimal('current_target', 8, 2);
            $table->timestamp('starting_date');
            $table->timestamp('ending_date');
            $table->boolean('active');
            $table->decimal('student_count');
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
        Schema::dropIfExists('goals');
    }
}
