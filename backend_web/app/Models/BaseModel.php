<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Log;

class BaseModel extends Model
{
    use Log;

    protected const CREATED_AT = "insert_date";
    protected const UPDATED_AT = "update_date";
    protected const DELETED_AT = "delete_date";
}
