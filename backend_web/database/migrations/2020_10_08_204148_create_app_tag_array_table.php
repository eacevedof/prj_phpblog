<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTagArrayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('app_tag_array', function(Blueprint $table)
		{
			$table->string("processflag", 5)->nullable();
			$table->string("insert_platform", 3)->nullable()->default('1');
			$table->string("insert_user", 15)->nullable();
			$table->timestamp('insert_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string("update_platform", 3)->nullable();
			$table->string("update_user", 15)->nullable();
			$table->timestamp('update_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string("delete_platform", 3)->nullable();
			$table->string("delete_user", 15)->nullable();
			$table->dateTime('delete_date')->nullable();
			$table->string("cru_csvnote", 500)->nullable();
			$table->string("is_erpsent", 3)->nullable()->default('0');
			$table->string("is_enabled", 3)->nullable()->default('1');
			$table->integer('i')->nullable();
			$table->integer("id", true);
			$table->string("code_erp", 25)->nullable();
			$table->string("type", 15)->nullable();
			$table->string("id_tosave", 25)->nullable();
			$table->string("description", 250)->nullable();
			$table->string("slug", 150)->nullable();
			$table->integer('order_by')->default(100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('app_tag_array');
	}

}
