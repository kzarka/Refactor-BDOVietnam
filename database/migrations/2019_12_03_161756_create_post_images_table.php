<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uniq_path')->nullable();
            $table->string('name')->nullable();
            $table->string('fixed_url')->nullable();
            $table->string('collection')->nullable();
            $table->unsignedInteger('review_id');
            $table->foreign('review_id')
                ->references('id')
                ->on('reviews')
                ->onDelete('cascade');
            $table->index('review_id');
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
        Schema::dropIfExists('post_images');
    }
}
