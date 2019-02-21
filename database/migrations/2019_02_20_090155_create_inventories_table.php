<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',254);
            $table->text('description')->nullable();
            $table->string('contact_name',254);
            $table->string('contact_email',254);
            $table->string('contact_phone',20);
            $table->string('contact_fax',20);
            $table->integer('matp')->unsigned();
            $table->integer('maqh')->unsigned();
            $table->integer('xaid')->unsigned();
            $table->string('lat',50);
            $table->string('lng',50);
            $table->boolean('status')->defaultsTo(1);
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
        Schema::dropIfExists('inventories');
    }
}
