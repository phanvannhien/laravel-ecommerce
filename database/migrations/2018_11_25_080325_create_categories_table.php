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
        if(!Schema::hasTable('categories'))
            Schema::create('categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug',254)->index();
                $table->string('image',254);
                $table->boolean('status')->defaultsTo(1);
                $table->nestedSet();
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
