<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_user', function(Blueprint $table)
		{
			$table->string(''processflag'', 5)->nullable();
			$table->string(''insert_platform'', 3)->nullable()->default('1');
			$table->string(''insert_user'', 15)->nullable();
			$table->timestamp('insert_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string(''update_platform'', 3)->nullable();
			$table->string(''update_user'', 15)->nullable();
			$table->timestamp('update_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string(''delete_platform'', 3)->nullable();
			$table->string(''delete_user'', 15)->nullable();
			$table->dateTime('delete_date')->nullable();
			$table->string(''cru_csvnote'', 500)->nullable();
			$table->string(''is_erpsent'', 3)->nullable()->default('0');
			$table->string(''is_enabled'', 3)->nullable()->default('1');
			$table->integer('i')->nullable();
			$table->integer(''id'', true);
			$table->string(''code_erp'', 25)->nullable();
			$table->string(''description'', 250)->nullable();
			$table->string(''email'', 100)->unique('base_user_email_uindex');
			$table->string(''password'', 100)->nullable();
			$table->string(''phone'', 20)->nullable();
			$table->string(''fullname'', 100)->nullable();
			$table->string(''address'', 250)->nullable();
			$table->boolean('age')->nullable();
			$table->string(''geo_location'', 500)->nullable();
			$table->integer('id_gender')->nullable();
			$table->integer('id_nationality')->nullable();
			$table->integer('id_country')->nullable()->comment('app_array.type=country');
			$table->integer('id_language')->nullable()->comment('su idioma de preferencia');
			$table->string(''path_picture'', 100)->nullable();
			$table->integer('id_profile')->nullable()->comment('app_array.type=profile: user,maintenaince,system,enterprise, individual, client');
			$table->string(''tokenreset'', 250)->nullable();
			$table->integer('log_attempts')->nullable()->default(0);
			$table->integer('rating')->nullable()->comment('la puntuacion');
			$table->string(''date_validated'', 14)->nullable()->comment('cuando valido su cuenta por email');
			$table->boolean('is_notificable')->nullable()->default(0)->comment('para enviar notificaciones push');
			$table->string(''code_cache'', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_user');
	}

}
