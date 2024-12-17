<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromProductSetups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_setups', function ($table) {
            $table->dropColumn(['value', 'list_values']);
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
        Schema::table('product_setups', function ($table) {
            $table->string('value')->nullable();
            $table->string('list_values')->nullable();
        });
    }
}
