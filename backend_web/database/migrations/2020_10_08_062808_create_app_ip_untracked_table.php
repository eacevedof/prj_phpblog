<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppIpUntrackedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('app_ip_untracked', function(Blueprint $table)
		{
			$table->integer("id", true);
			$table->timestamp('insert_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('update_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string("remote_ip", 100)->unique('remote_ip');
			$table->string("country", 50)->nullable();
			$table->string("whois", 200)->nullable();
			$table->string("comment", 200)->nullable();
			$table->boolean('is_enabled')->nullable()->default(1)->index('is_enabled');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('app_ip_untracked');
	}

}
