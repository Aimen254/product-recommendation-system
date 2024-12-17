<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_setups', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('field')->nullable();
            $table->string('value')->nullable();
            $table->string('type')->nullable();
            $table->string('validation')->nullable();
            $table->enum('is_list', ['0', '1'])->nullable();
            $table->string('list_values')->nullable();
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
        Schema::dropIfExists('product_setups');
    }
}
