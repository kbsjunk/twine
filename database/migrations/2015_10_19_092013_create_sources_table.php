<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->index();
			$table->string('locale');
			$table->string('format')->default('twine');
            $table->string('url')->nullable();
			$table->string('path')->nullable();
            $table->timestamps();
            $table->softDeletes();
			$table->dateTime('crawled_at')->nullable();
			$table->unsignedInteger('created_by');
			$table->unsignedInteger('project_id')->nullable();

			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sources');
    }
}
