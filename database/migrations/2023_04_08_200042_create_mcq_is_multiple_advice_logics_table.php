<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqIsMultipleAdviceLogicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_is_multiple_advice_logics', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->integer('project_id');
            $table->integer('question_id');
            $table->integer('answer_id');
            $table->integer('product_setup_id');
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
        Schema::dropIfExists('mcq_is_multiple_advice_logics');
    }
}
