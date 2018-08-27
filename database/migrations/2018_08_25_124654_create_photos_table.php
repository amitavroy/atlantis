<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('family_id');
            $table->unsignedInteger('gallery_id');

            $table->string('path');
            $table->string('filename');
            $table->string('caption')->nullable();
            $table->string('alt')->nullable();
            $table->index('user_id');

            $table->index('family_id');
            $table->index('gallery_id');
            $table->index(['family_id', 'gallery_id']);

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
        Schema::dropIfExists('photos');
    }
}
