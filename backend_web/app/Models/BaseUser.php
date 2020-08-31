<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseUser
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
 * @property string $email
 * @property string|null $password
 * @property string|null $phone
 * @property string|null $fullname
 * @property string|null $address
 * @property int|null $age
 * @property string|null $geo_location
 * @property int|null $id_gender
 * @property int|null $id_nationality
 * @property int|null $id_country
 * @property int|null $id_language
 * @property string|null $path_picture
 * @property int|null $id_profile
 * @property string|null $tokenreset
 * @property int|null $log_attempts
 * @property int|null $rating
 * @property string|null $date_validated
 * @property int|null $is_notificable
 * @property string|null $code_cache
 *
 * @package App\Models
 */
class BaseUser extends BaseModel
{
	protected $table = 'base_user';
	public $timestamps = false;

	protected $casts = [
		'i' => 'int',
		'age' => 'int',
		'id_gender' => 'int',
		'id_nationality' => 'int',
		'id_country' => 'int',
		'id_language' => 'int',
		'id_profile' => 'int',
		'log_attempts' => 'int',
		'rating' => 'int',
		'is_notificable' => 'int'
	];

	protected $dates = [
		'insert_date',
		'update_date',
		'delete_date'
	];

	protected $hidden = [
		'password'
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
		'email',
		'password',
		'phone',
		'fullname',
		'address',
		'age',
		'geo_location',
		'id_gender',
		'id_nationality',
		'id_country',
		'id_language',
		'path_picture',
		'id_profile',
		'tokenreset',
		'log_attempts',
		'rating',
		'date_validated',
		'is_notificable',
		'code_cache'
	];
}
