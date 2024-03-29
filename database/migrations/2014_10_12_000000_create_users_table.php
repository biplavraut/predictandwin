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
            $table->string('slug')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('image')->nullable()->default('no-image.png');
            $table->tinyInteger('enabled')->default(0);
            $table->enum('type', ['guest', 'normal', 'premium'])->default('guest');
            $table->string('played')->nullable()->default(0);
            $table->string('solved')->nullable()->default(0);
            $table->string('point')->nullable()->default(0);
            $table->string('rank')->nullable()->default(0);
            $table->dateTime('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('device_token')->unique()->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
