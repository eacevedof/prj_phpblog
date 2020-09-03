<?php
namespace App\Services;
use Illuminate\Http\Request;
use App\Traits\Log;
use App\Traits\UidTrait;
use App\Traits\EnvTrait;

class BaseService
{
    use Log, EnvTrait, UidTrait;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request =$request;
    }

    protected function get_env($key)
    {
        return $_ENV[$key] ?? "";
    }

    protected function get_post($key)
    {
        return $this->request->request->get($key) ?? null;
    }

    protected function get_get($key)
    {
        return $this->request->query->get($key) ?? null;
    }

    protected function get_userid($codCache="")
    {

    }

    protected function clean_sysfields(&$data)
    {
        $sysfields = ["insert_date","delete_date","update_date"];
        foreach ($data as $field => $value)
            if(in_array($field, $sysfields))
                unset($data[$field]);
        return $sysfields;
    }

    protected function get_platform()
    {
        //$this->logd($_SERVER['HTTP_USER_AGENT'],"agente ios");
        //Detect special conditions devices
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
        $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $macos = stripos($_SERVER['HTTP_USER_AGENT'],"Macintosh");

        //0: etl, 1: unknownk, 2: desktop, 3:android, 4:iphone, 5:ipad, 6:macos

        //do something with this information
        if( $iPod || $iPhone ){
            return 4;
        }else if($iPad){
            return 5;
        }else if($Android){
            return 3;
        }else if($macos){
            return 6;
        }else if($webOS)
        {
            return 2;
        }
        return 1;
    }
}
