<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('answer')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('daily')->default(1);
            $table->tinyInteger('take_a_quiz')->default(1);
            $table->enum('difficulty', ['easy', 'moderate', 'hard'])->default('easy');
            $table->tinyInteger('display')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->string('point')->nullable();
            $table->string('premium_point')->nullable();
            $table->bigInteger('order_item')->nullable();
            $table->text('excerpt')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
            $table->string('updated_by')->nullable();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
