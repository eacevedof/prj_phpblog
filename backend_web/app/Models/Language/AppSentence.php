<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Language;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppSentence
 *
 * @property string|null $processflag
 * @property string|null $insert_platform
 * @property string|null $insert_user
 * @property Carbon $insert_date
 * @property string|null $update_platform
 * @property string|null $update_user
 * @property Carbon|null $update_date
 * @property string|null $delete_platform
 * @property string|null $delete_user
 * @property Carbon|null $delete_date
 * @property string|null $cru_csvnote
 * @property string|null $is_erpsent
 * @property string|null $is_enabled
 * @property int|null $i
 * @property int $id
 * @property string|null $code_erp
 * @property string|null $description
 * @property int $id_subject
 * @property string|null $translatable
 * @property int|null $id_language
 * @property int|null $is_notificable
 * @property int|null $id_type
 * @property string|null $code_cache
 *
 * @package App\Models
 */
class AppSentence extends Model
{
	protected $table = 'app_sentence';
	public $timestamps = false;

	protected $casts = [
		'i' => 'int',
		'id_subject' => 'int',
		'id_language' => 'int',
		'is_notificable' => 'int',
		'id_type' => 'int'
	];

	protected $dates = [
		'insert_date',
		'update_date',
		'delete_date'
	];

	protected $fillable = [
		'processflag',
		'insert_platform',
		'insert_user',
		'insert_date',
		'update_platform',
		'update_user',
		'update_date',
		'delete_platform',
		'delete_user',
		'delete_date',
		'cru_csvnote',
		'is_erpsent',
		'is_enabled',
		'i',
		'code_erp',
		'description',
		'id_subject',
		'translatable',
		'id_language',
		'is_notificable',
		'id_type',
		'code_cache'
	];
}
