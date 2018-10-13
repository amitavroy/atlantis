<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGitProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('git_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_url');
            $table->integer('stars')->nullable();
            $table->integer('issues')->nullable();
            $table->text('meta')->nullable();
            $table->timestamp('sticky')->nullable();
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
        Schema::dropIfExists('git_projects');
    }
}
