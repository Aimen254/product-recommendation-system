<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdviceLogicConditionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_logic_condition_options', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('advice_logic_condition_id')->nullable()->constrained('advice_logic_conditions')->onDelete('SET NULL');
            $table->integer('answer_id')->nullable()->constrained('answers')->onDelete('SET NULL');
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
        Schema::dropIfExists('advice_logic_condition_options');
    }
}
