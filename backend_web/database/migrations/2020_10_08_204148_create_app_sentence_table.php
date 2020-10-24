<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSentenceTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_sentence', function(Blueprint $table)
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
			$table->string("description", 250)->nullable();
			$table->integer('id_subject')->comment('app_subject.id');
			$table->integer('id_context')->nullable()->comment('app_array.id (lang-contexts)');
			$table->string("translatable", 2000)->nullable()->comment('texto principal');
			$table->integer('id_language')->nullable()->comment('app_language.id');
			$table->boolean('is_notificable')->nullable()->comment('indica si se tomará en cuenta para examen');
			$table->integer('id_type')->nullable()->comment('si estan en algún grupo');
			$table->integer('id_status')->nullable()->comment('activo o inactivo');
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
        Schema::drop('app_sentence');
    }

}
