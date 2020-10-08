<?php
namespace App\Services\Common\Infrastructure;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class InfrastructureService extends BaseService
{
    public function __construct(){;}

    public static function get_maxsize()
    {
        $max_upload = (int)(ini_get("upload_max_filesize"));
        $max_post = (int)(ini_get("post_max_size"));
        //$memory_limit = (int)(ini_get("memory_limit"));//en prod me devuelve -1
        $upload_mb = min($max_upload, $max_post);
        //en prod son 64M para upload y post
        //lg("get_maxsize(): upload_max_filesize:$max_upload, post_max_size:$max_post","get_maxsize");
        return $upload_mb;
    }

    public static function get_maxsize_bytes(){
        $size = self::get_maxsize()."MB";
        return \get_in_bytes($size);
    }

    public static function is_ipuntracked(){
        //$remoteip = \Request::ip();
        $remoteip = $_SERVER["REMOTE_ADDR"] ?? "";
        $r = DB::table("app_ip_untracked")
            ->select(["id"])
            ->where("remote_ip","=","$remoteip")
            ->where("is_enabled","=","1")
            ->get();
        if($r->isEmpty()) return false;
        return true;
    }

    public static function get_platform(){
        //$this->logd($_SERVER["HTTP_USER_AGENT"],"agente ios");
        //Detect special conditions devices
        $iPod    = stripos($_SERVER["HTTP_USER_AGENT"],"iPod");
        $iPhone  = stripos($_SERVER["HTTP_USER_AGENT"],"iPhone");
        $iPad    = stripos($_SERVER["HTTP_USER_AGENT"],"iPad");
        $Android = stripos($_SERVER["HTTP_USER_AGENT"],"Android");
        $webOS   = stripos($_SERVER["HTTP_USER_AGENT"],"webOS");
        $macos = stripos($_SERVER["HTTP_USER_AGENT"],"Macintosh");

        //0: etl, 1: unknownk, 2: web desktop, 3:android, 4:iphone, 5:ipad, 6:macos

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
