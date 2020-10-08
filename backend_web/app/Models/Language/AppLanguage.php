<?php
namespace App\Models\Language;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppLanguage
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
 * @property string|null $translated
 * @property string|null $language
 * @property int|null $id_parent
 * @property string|null $code_cache
 *
 * @package App\Models\Language
 */
class AppLanguage extends Model
{
    protected $table = 'app_language';
    public $timestamps = false;

    protected $casts = [
        'i' => 'int',
        'id_parent' => 'int'
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
        'translated',
        'language',
        'id_parent',
        'code_cache'
    ];
}
