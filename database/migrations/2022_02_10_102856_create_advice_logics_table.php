<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdviceLogicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_logics', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('project_id')->nullable()->constrained('projects')->onDelete('SET NULL');
            $table->integer('advice_id')->nullable()->constrained('advices')->onDelete('SET NULL');
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
        Schema::dropIfExists('advice_logics');
    }
}
