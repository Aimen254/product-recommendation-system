<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinishedColumnToProjectResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_responses', function (Blueprint $table) {
            $table->string('finished')->nullable()->after('project_id');
            $table->string('advice_id')->nullable()->after('project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_responses', function (Blueprint $table) {
            $table->dropColumn('finished');
            $table->dropColumn('advice_id');
        });
    }
}
