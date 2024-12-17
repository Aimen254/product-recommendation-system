<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->id();
            $table->string('page')->nullable();
            $table->string('general_background')->nullable();
            $table->string('image')->nullable();
            $table->string('font')->nullable();
            $table->string('title_color')->nullable();
            $table->string('description_color')->nullable();
            $table->string('button_background_color')->nullable();
            $table->string('button_text_color')->nullable();
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
        Schema::dropIfExists('styles');
    }
}
