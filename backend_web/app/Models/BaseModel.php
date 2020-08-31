<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Log;

class BaseModel extends Model
{
    use Log;
}
