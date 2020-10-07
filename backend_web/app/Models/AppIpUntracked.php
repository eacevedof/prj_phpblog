<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppIpUntracked
 *
 * @property int $id
 * @property Carbon|null $insert_date
 * @property Carbon $update_date
 * @property string $remote_ip
 * @property string|null $country
 * @property string|null $whois
 * @property string|null $comment
 * @property int|null $is_enabled
 *
 * @package App\Models
 */
class AppIpUntracked extends Model
{
	protected $table = 'app_ip_untracked';
	public $timestamps = false;

	protected $casts = [
		'is_enabled' => 'int'
	];

	protected $dates = [
		'insert_date',
		'update_date'
	];

	protected $fillable = [
		'insert_date',
		'update_date',
		'remote_ip',
		'country',
		'whois',
		'comment',
		'is_enabled'
	];
}
