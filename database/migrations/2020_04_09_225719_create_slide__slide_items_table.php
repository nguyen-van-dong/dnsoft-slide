<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlideSlideItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide__slide_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('slide_id');
            $table->{database_jsonable()}('name')->nullable();
            $table->{database_jsonable()}('description')->nullable();
            $table->{database_jsonable()}('content')->nullable();
            $table->{database_jsonable()}('attributes')->nullable();
            $table->{database_jsonable()}('link')->nullable();
            $table->boolean('is_active')->default(1);
            $table->unsignedSmallInteger('sort_order')->nullable();
            $table->timestamps();

            $table->foreign('slide_id')->references('id')->on('slide__slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide__slide_items');
    }
}
