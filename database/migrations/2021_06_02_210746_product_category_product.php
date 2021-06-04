<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductCategoryProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category_product', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id')->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedBigInteger('p_category_id')->index()->nullable();
            $table->foreign('p_category_id')->references('id')->on('product_category')
                ->cascadeOnUpdate()->cascadeOnDelete();

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
        Schema::dropIfExists('product_category_product');
    }
}
