<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('type_attributes'))
            Schema::create('type_attributes', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('type_id')->unsigned();
                $table->integer('attribute_id')->unsigned();

                $table->boolean('is_user_defined')->defaultsTo(1);

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
        Schema::dropIfExists('type_attributes');
    }
}
