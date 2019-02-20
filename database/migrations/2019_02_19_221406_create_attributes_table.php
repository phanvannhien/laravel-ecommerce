<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',200);
            $table->string('admin_name',200);
            $table->string('type',200);
            $table->string('validation',200)->nullable();
            $table->integer('position')->nullable();
            $table->boolean('is_required')->defaultsTo(0);
            $table->boolean('is_unique')->defaultsTo(0);
            $table->boolean('is_filterable')->defaultsTo(0);
            $table->boolean('is_configurable')->defaultsTo(0);
            $table->boolean('is_visible_on_front')->defaultsTo(0);
            $table->boolean('is_user_defined')->defaultsTo(0);
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
        Schema::dropIfExists('attributes');
    }
}
