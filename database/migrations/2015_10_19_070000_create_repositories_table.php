<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->index();
			$table->string('format')->default('apache');
			$table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
			$table->dateTime('crawled_at')->nullable();
			$table->unsignedInteger('created_by');

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
        Schema::drop('repositories');
    }
}
