<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('p_id');
            $table->string('p_name', 255);
            $table->bigInteger('p_price');
            $table->bigInteger('p_discount_price');
            $table->boolean('p_discount_active');
            $table->timestamps();
            //$table->foreign('product_category_id')->references('category_id')->on('product_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
