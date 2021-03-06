<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppTag
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
 * @property int|null $id_type
 * @property string|null $description
 * @property int|null $id_user
 * @property string|null $slug
 * @property int $order_by
 * @property string|null $code_cache
 *
 * @package App\Models
 */
class AppTag extends BaseModel
{
	protected $table = 'app_tag';
	public $timestamps = false;

	protected $casts = [
		'i' => 'int',
		'id_type' => 'int',
		'id_user' => 'int',
		'order_by' => 'int'
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
		'id_type',
		'description',
		'id_user',
		'slug',
		'order_by',
		'code_cache'
	];
}
