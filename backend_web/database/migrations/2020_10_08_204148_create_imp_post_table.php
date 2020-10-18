<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imp_post', function(Blueprint $table)
		{
			$table->integer("id", true);
			$table->string("code_erp", 25)->nullable();
			$table->string("publish_date", 20)->nullable();
			$table->string("last_update", 20)->nullable();
			$table->string("title", 500)->nullable();
			$table->text('content')->nullable();
			$table->string("excerpt", 2000)->nullable();
			$table->string("id_status", 100)->nullable();
			$table->string("slug", 300)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imp_post');
	}

}
