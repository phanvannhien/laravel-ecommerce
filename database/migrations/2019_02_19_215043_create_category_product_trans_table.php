<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_trans', function (Blueprint $table) {

                $table->increments('id');
                $table->string('language_code',10)->index();
                $table->integer('category_id')->unsigned();

                $table->string('category_name', 255 );
                $table->text('category_description')->nullable();
                $table->string('slug',254);
                $table->timestamps();

                $table->foreign('category_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product_trans');
    }
}
