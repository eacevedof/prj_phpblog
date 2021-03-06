<?php
namespace App\Models\Language;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppSubject
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
 * @property string|null $url_final
 * @property string|null $url_img1
 * @property string|null $url_img2
 * @property string|null $title
 * @property string|null $excerpt
 * @property string|null $url_resource
 * @property int|null $id_type_source
 * @property int|null $id_status
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $seo_keywords
 * @property string|null $code_cache
 *
 * @package App\Models\Language
 */
class AppSubject extends Model
{
    protected $table = 'app_subject';
    public $timestamps = false;

    protected $casts = [
        'i' => 'int',
        'id_type_source' => 'int',
        'id_status' => 'int'
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
        'slug',
        'url_final',
        'url_img1',
        'url_img2',
        'title',
        'excerpt',
        'url_resource',
        'id_type_source',
        'id_status',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'code_cache'
    ];
}
