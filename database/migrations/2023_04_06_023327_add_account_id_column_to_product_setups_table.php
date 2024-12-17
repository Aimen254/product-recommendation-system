<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountIdColumnToProductSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_setups', function (Blueprint $table) {
            $table->integer('account_id')->nullable()->constrained('accounts')->onDelete('SET NULL')->after('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_setups', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });
    }
}
