<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppPost
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
 * @property string|null $slug
 * @property int|null $is_page
 * @property string|null $url_final
 * @property int|null $id_type
 * @property string|null $url_img1
 * @property string|null $url_img2
 * @property string|null $url_img3
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $excerpt
 * @property string|null $content
 * @property int|null $id_user
 * @property int|null $id_status
 * @property Carbon|null $publish_date
 * @property Carbon|null $last_update
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int $order_by
 * @property string|null $code_cache
 *
 * @package App\Models
 */
class AppPost extends Model
{
	protected $table = 'app_post';
	public $timestamps = false;

	protected $casts = [
		'i' => 'int',
		'is_page' => 'int',
		'id_type' => 'int',
		'id_user' => 'int',
		'id_status' => 'int',
		'order_by' => 'int'
	];

	protected $dates = [
		'insert_date',
		'update_date',
		'delete_date',
		'publish_date',
		'last_update'
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
		'slug',
		'is_page',
		'url_final',
		'id_type',
		'url_img1',
		'url_img2',
		'url_img3',
		'title',
		'subtitle',
		'excerpt',
		'content',
		'id_user',
		'id_status',
		'publish_date',
		'last_update',
		'seo_title',
		'seo_description',
		'order_by',
		'code_cache'
	];
}
