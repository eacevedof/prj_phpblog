<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Language;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppPostComment
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
 * @property int|null $id_post
 * @property int|null $id_parent
 * @property string|null $name
 * @property string|null $email
 * @property string|null $site
 * @property string|null $content
 * @property int|null $num_likes
 * @property int|null $num_dislikes
 * @property int|null $is_active
 * @property string|null $code_cache
 *
 * @package App\Models\Language
 */
class AppPostComment extends Model
{
	protected $table = 'app_post_comments';
	public $timestamps = false;

	protected $casts = [
		'i' => 'int',
		'id_post' => 'int',
		'id_parent' => 'int',
		'num_likes' => 'int',
		'num_dislikes' => 'int',
		'is_active' => 'int'
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
		'id_post',
		'id_parent',
		'name',
		'email',
		'site',
		'content',
		'num_likes',
		'num_dislikes',
		'is_active',
		'code_cache'
	];
}
