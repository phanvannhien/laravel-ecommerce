<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('blog_tags'))
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('blog_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            //$table->primary(['category_id','product_id']);

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');

            $table->foreign('blog_id')
                ->references('id')
                ->on('blogs')
                ->onDelete('cascade');

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
        Schema::dropIfExists('blog_tags');
    }
}
