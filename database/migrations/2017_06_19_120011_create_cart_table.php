<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->char('cookie_id', 16)->index();
            $table->unsignedInteger('product_id');
            $table->decimal('qty',15,3)->default(0,000)->unsigned();
            $table->decimal('weight',15,3)->default(0,000)->unsigned();
            $table->decimal('total_sum',15,2)->default(0,00)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
