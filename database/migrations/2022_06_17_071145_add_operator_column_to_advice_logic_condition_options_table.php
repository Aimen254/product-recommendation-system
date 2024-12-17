<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperatorColumnToAdviceLogicConditionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advice_logic_condition_options', function (Blueprint $table) {
            $table->string('operator')->after('answer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advice_logic_condition_options', function (Blueprint $table) {
            $table->dropColumn('operator');
        });
    }
}
