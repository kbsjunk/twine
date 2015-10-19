<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strings', function (Blueprint $table) {
            $table->increments('id');
			$table->string('locale');
			$table->string('uri')->nullable();
			$table->string('key');
			$table->string('value');
			$table->string('plural')->nullable();
            $table->text('comment');
            $table->timestamps();
            $table->softDeletes();
			$table->unsignedInteger('created_by');
			$table->unsignedInteger('source_id')->nullable();
			
			$table->unique(['source_id', 'locale', 'uri']);

            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
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
        Schema::drop('strings');
    }
}
