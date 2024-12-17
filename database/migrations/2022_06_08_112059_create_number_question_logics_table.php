<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumberQuestionLogicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_question_logics', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('selected_question_id')->nullable();
            $table->integer('next_question_id')->nullable();
            $table->integer('firstValue')->nullable();
            $table->integer('secondValue')->nullable();
            $table->string('firstOperator')->nullable();
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
        Schema::dropIfExists('number_question_logics');
    }
}
