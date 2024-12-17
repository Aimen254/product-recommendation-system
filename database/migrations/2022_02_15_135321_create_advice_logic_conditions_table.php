<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdviceLogicConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_logic_conditions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('advice_logic_id')->nullable()->constrained('advice_logics')->onDelete('SET NULL');
            $table->integer('question_id')->nullable()->constrained('questions')->onDelete('SET NULL');
            $table->enum('condition',['and','or','base']);
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
        Schema::dropIfExists('advice_logic_conditions');
    }
}
