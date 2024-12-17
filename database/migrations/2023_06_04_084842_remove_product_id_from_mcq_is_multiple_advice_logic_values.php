<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProductIdFromMcqIsMultipleAdviceLogicValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mcq_is_multiple_advice_logic_values', function ($table) {
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Method to recreate the columns in case of rollback
        Schema::table('mcq_is_multiple_advice_logic_values', function ($table) {
            $table->unsignedBigInteger('product_id');
        });
    }
}
