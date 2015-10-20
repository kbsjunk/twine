<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->index();
			$table->string('branch')->default('master')->index();
			$table->string('format')->default('twine');
			$table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
			$table->dateTime('crawled_at')->nullable();
			$table->unsignedInteger('created_by');
			$table->unsignedInteger('repository_id')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('repository_id')->references('id')->on('repositories')->onDelete('restrict');
			$table->unique(['name', 'branch', 'repository_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
