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
        if(!Schema::hasTable('products'))
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->enum('type',['SIMPLE','CONFIGURABLE','GROUP','DOWNLOADABLE'])->index();
                $table->string('slug',254)->index();
                $table->integer('type_id')->unsigned();
                $table->string('meta_title',254);
                $table->string('meta_description',254);
                $table->string('thumbnail',254)->nullable();

                //                $table->integer('price')->unsigned();
//                $table->integer('sale_price')->defaultsTo(0);
//                $table->timestamps('sale_from_date')->nullable();
//                $table->timestamps('sale_to_date')->nullable();
//                $table->boolean('is_new')->defaultsTo(0);
//                $table->boolean('is_featured')->defaultsTo(0);
//                $table->integer('weight')->nullable();
//                $table->integer('width')->nullable();
//                $table->integer('height')->nullable();
//                $table->integer('length')->nullable();

                //$table->integer('stock')->unsigned()->defaultsTo(0);

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
