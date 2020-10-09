<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Traits\Log;
use App\Traits\UidTrait;
use App\Traits\EnvTrait;
use App\Traits\SysfieldsTrait;
use Illuminate\Support\Facades\DB;

class BaseService
{
    use Log, EnvTrait, UidTrait, SysfieldsTrait;

    protected $request;

    public function __construct(Request $request=null)
    {
        $this->request =$request;
    }

    protected function get_post($key){return $this->request->input($key);}

    protected function get_get($key){return $this->request->query($key);}

    protected function get_userid($codCache=""){}

    protected function get_table($table){return DB::table($table);}
  }
