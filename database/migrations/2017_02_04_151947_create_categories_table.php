<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0)->index();
            $table->string('url')->unique();
            $table->string('full_url')->unique();
            $table->string('title');
            $table->string('nav_title');
            $table->string('standard')->default('');
            $table->string('additionally')->default('');
            $table->string('img');
            $table->text('text');
            $table->text('description');
            $table->string('breadcrumbs',1024);
            $table->unsignedSmallInteger('sort')->default(0);
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
        Schema::dropIfExists('categories');
    }
}
