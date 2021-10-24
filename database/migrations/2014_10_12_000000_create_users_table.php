<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('device_token')->nullable();
            $table->string('pin')->nullable();
            $table->boolean('biometric')->default(false);
            $table->boolean('two_factor')->default(false);
            $table->string('two_factor_code')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('avatar')->default('no-image.png');
            $table->string('phone');
            $table->string('country');
            $table->date('dob');
            $table->enum('gender', ['male','female'])->nullanle();
            $table->string('address')->nullanle();
            $table->string('street')->nullanle();
            $table->string('city')->nullanle();
            $table->string('zipcode')->nullanle();
            $table->string('about_me')->nullanle();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);
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
        Schema::dropIfExists('users');
    }
}
