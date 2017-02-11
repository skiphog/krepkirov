<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->char('id_1c', 36);
            //$table->unsignedInteger('product_id');
            //$table->foreign('product_id')->references('id')->on('product');

            $table->string('name');
            $table->decimal('price', 15, 2);
            $table->string('unit', 50);
            $table->decimal('quantity',15,3);
            $table->decimal('sum', 15, 2);




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
