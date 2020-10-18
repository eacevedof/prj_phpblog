<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('app_post', function(Blueprint $table)
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
			$table->string("description", 250)->nullable()->comment('para seo: 160 cjars');
			$table->string("slug", 150)->nullable();
			$table->boolean('is_page')->nullable()->default(0);
			$table->string("url_final", 300)->nullable();
			$table->integer('id_type')->nullable()->default(1)->comment('ar(10) categories');
			$table->string("url_img1", 300)->nullable()->comment('foto portada');
			$table->string("url_img2", 300)->nullable()->comment('foto listado');
			$table->string("url_img3", 300)->nullable()->comment('foto detalle');
			$table->string("title", 350)->nullable();
			$table->string("subtitle", 200)->nullable();
			$table->string("excerpt", 1000)->nullable();
			$table->text('content')->nullable();
			$table->integer('id_user')->nullable()->default(1)->comment('author');
			$table->boolean('id_status')->nullable()->default(0)->comment('ar(20) 1:enabled, 0:disabled');
			$table->dateTime('publish_date')->nullable();
			$table->dateTime('last_update')->nullable();
			$table->integer('num_likes')->nullable();
			$table->integer('num_dislikes')->nullable();
			$table->string("seo_title", 65)->nullable();
			$table->string("seo_description", 160)->nullable();
			$table->string("seo_keywords", 160)->nullable();
			$table->integer('order_by')->default(100);
			$table->string("code_cache", 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('app_post');
	}

}
