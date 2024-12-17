<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectResponseAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_response_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('project_response_id')->nullable();
            $table->integer('answer_id')->nullable();
            $table->string('answer')->nullable();
            $table->integer('question_id')->nullable();
            $table->string('question')->nullable();
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
        Schema::dropIfExists('project_response_answers');
    }
}
