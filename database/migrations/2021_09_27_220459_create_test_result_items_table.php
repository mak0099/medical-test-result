<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_result_items', function (Blueprint $table) {
            $table->id();
            $table->string('test_name')->nullable();
            $table->string('result');
            $table->string('reference_ranges')->nullable();
            $table->bigInteger('test_result_id')->unsigned();
			$table->foreign('test_result_id')->references('id')->on('test_results')->onDelete('CASCADE');
            $table->bigInteger('medical_test_id')->unsigned();
			$table->foreign('medical_test_id')->references('id')->on('medical_tests')->onDelete('CASCADE');
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
        Schema::dropIfExists('test_result_items');
    }
}
