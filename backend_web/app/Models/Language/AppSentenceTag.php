<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Language;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppSentenceTag
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
 * @property int $id_sentence
 * @property int $id_tag
 * @property string|null $code_cache
 *
 * @package App\Models\Language
 */
class AppSentenceTag extends Model
{
	protected $table = 'app_sentence_tags';
	public $timestamps = false;

	protected $casts = [
		'i' => 'int',
		'id_sentence' => 'int',
		'id_tag' => 'int'
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
		'id_sentence',
		'id_tag',
		'code_cache'
	];
}
