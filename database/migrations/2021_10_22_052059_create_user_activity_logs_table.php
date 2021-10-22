<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('activity')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('quiz_id')->nullable();
            $table->tinyInteger('answer')->nullable()->default(0);
            $table->string('point')->nullable();
            $table->enum('reward', ['earned', 'redeme', 'invalid'])->default('invalid');
            $table->enum('type', ['quiz', 'prediction', 'profile', 'password', 'reward', 'ads', 'misc'])->nullable()->default('misc');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activity_logs');
    }
}
