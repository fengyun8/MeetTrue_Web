<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_galleries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tag_id')->comment('标签id');
            $table->bigInteger('gallery_id')->comment('作品id');
            $table->string('tag_name')->comment('冗余: 标签名');
            $table->timestamps();

            $table->unique(['tag_id', 'gallery_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tag_galleries');
    }
}
