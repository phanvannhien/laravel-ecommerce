<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language_code',10)->index();
            $table->integer('product_id')->unsigned();
            $table->integer('attribute_value')->unsigned();
            $table->text('text_value')->nullable();
            $table->integer('integer_value')->nullable();
            $table->float('float_value')->nullable();
            $table->timestamp('datetime_value')->nullable();
            $table->json('json_value')->nullable();

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
        Schema::dropIfExists('product_attribute_values');
    }
}
