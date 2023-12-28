<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderSliderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider__slider_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('slider_id');
            $table->{database_jsonable()}('name')->nullable();
            $table->{database_jsonable()}('description')->nullable();
            $table->{database_jsonable()}('content')->nullable();
            $table->{database_jsonable()}('attributes')->nullable();
            $table->{database_jsonable()}('link')->nullable();
            $table->boolean('is_active')->default(1);
            $table->unsignedSmallInteger('sort_order')->nullable();
            $table->timestamps();

            $table->foreign('slider_id')->references('id')->on('slider__sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider__slider_items');
    }
}
