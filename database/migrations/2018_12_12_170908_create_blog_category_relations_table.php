<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoryRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('blog_category_relations'))
        Schema::create('blog_category_relations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('blog_id')->unsigned();
            $table->integer('blogcategory_id')->unsigned();

            //$table->primary(['category_id','product_id']);

            $table->foreign('blogcategory_id')
                ->references('id')
                ->on('blog_categories')
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
        Schema::dropIfExists('blog_category_relations');
    }
}
