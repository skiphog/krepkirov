<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->char('1c_id', 36)->unique();
            $table->unsignedInteger('category_id')->index();
            $table->string('title');
            $table->text('body');
            $table->string('image')->default('');
            $table->decimal('price_1',15,3)->default(0,000);
            $table->decimal('price_2',15,3)->default(0,000);
            $table->decimal('price_3',15,3)->default(0,000);
            $table->decimal('quantity',15,3)->default(0,000);
            $table->decimal('weight',15,3)->default(0,000);
            $table->string('unit',50)->default('');
            $table->unsignedTinyInteger('sort')->default(0);
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
        Schema::dropIfExists('products');
    }
}
