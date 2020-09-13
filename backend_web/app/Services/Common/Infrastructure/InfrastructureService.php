<?php
namespace App\Services\Common\Infrastructure;

use App\Services\BaseService;

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
}
