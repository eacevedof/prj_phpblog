<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Traits\LogTrait as Log;
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
        return DB::table($table);
    }
    protected function _logquery($tile="")
    {
        $r = DB::getQueryLog();
        //$this->log($r,$tile);

        foreach ($r as $i=>$arparts){
            $query = $arparts["query"];

            //select
            $query = str_replace("` = ? ","` = %s ",$query);
            //update
            $query = str_replace("` = ?","` = '%s'",$query);
            //insert
            $query = str_replace("?","'%s'",$query);

            $query = str_replace("insert into ","\nINSERT INTO ",$query);
            $query = str_replace("`) values (","\n)\nVALUES\n(\n",$query);
            $query = str_replace("` (`","`\n(\n`",$query);

            $query = str_replace("select `","\nSELECT `",$query);
            $query = str_replace("select * ","\nSELECT * ",$query);
            $query = str_replace("update `","\nUPDATE `",$query);
            $query = str_replace(" from `","\nFROM `",$query);
            $query = str_replace(" where `","\nWHERE `",$query);
            $query = str_replace(" and `","\nAND `",$query);
            $query = str_replace("` set `","`\nSET\n`",$query);
            $query = str_replace(", `",",\n`",$query);

            $query = str_replace(" order by `","\nORDER BY `",$query);

            $params = $arparts["bindings"];
            $query .= "\n-- time({$arparts["time"]})";
            $finalq = vsprintf($query,$params);
            $this->log($finalq,"-- $tile");
            //$this->log($arparts,$tile);
        }

        //$this->log($r, $tile);
    }
  }
