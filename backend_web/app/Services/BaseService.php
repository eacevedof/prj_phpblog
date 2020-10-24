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

    protected function get_table($table){
        DB::enableQueryLog();
        return DB::table($table);
    }
    protected function _logquery($tile="")
    {
        $r = DB::getQueryLog();
        foreach ($r as $i=>$arparts){
            $query = $arparts["query"];

            $query = str_replace("` = ? ","` = %s ",$query);
            $query = str_replace(" from `","\nFROM `",$query);
            $query = str_replace(" where `","\nWHERE `",$query);
            $query = str_replace(" and `","\nAND `",$query);
            $query = str_replace(" order by `","\nORDER BY `",$query);

            $params = $arparts["bindings"];
            $query .= "\n-- time({$arparts["time"]})";
            $finalq = vsprintf($query,$params);
            $this->log($finalq,$tile);
            //$this->log($arparts,$tile);
        }

        //$this->log($r, $tile);
    }
  }
