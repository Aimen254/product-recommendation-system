<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqIsMultipleAdviceLogicValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_is_multiple_advice_logic_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advice_logic_id');
            $table->integer('product_id');
            $table->integer('value_id');
            $table->timestamps();
            $table->foreign('advice_logic_id')->references('id')->on('mcq_is_multiple_advice_logics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcq_is_multiple_advice_logic_values');
    }
}
