<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_carousel_images_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselImagesTable extends Migration
{
    public function up()
    {
        Schema::create('carousel_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path'); // Store the path of the image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carousel_images');
    }
}
