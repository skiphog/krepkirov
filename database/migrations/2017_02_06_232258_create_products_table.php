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
            $table->char('id_1c', 36)->unique();
            $table->unsignedInteger('category_id')->index()->default(0);
            $table->string('name');
            $table->text('description');
            $table->decimal('price_1',15,2)->default(0,00)->unsigned();
            $table->decimal('price_2',15,2)->default(0,00)->unsigned();
            $table->decimal('price_3',15,2)->default(0,00)->unsigned();
            $table->string('unit',50)->default('');
            $table->decimal('quantity',15,3)->default(0,000)->unsigned();
            $table->unsignedInteger('packing')->default(0);
            $table->string('image')->default('');
            $table->decimal('weight',15,3)->default(0,000)->unsigned();
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
