<?php
namespace App\Services\Common;

use App\Component\Curl;
use App\Services\BaseService;

class UploadService extends BaseService
{
    public function __construct(){;}

    private function _get_header($key=null)
    {
        $all = getallheaders();
        $this->logd($all,"get_header.all");
        if(!$key) return $all;
        foreach ($all as $k=>$v)
            if(strtolower($k)===strtolower($key))
                return $v;
        return null;
    }

    private function _get_origin(){
        $domain = $this->_get_header("origin");
        if(!$domain) $domain = $this->_get_header("host");
        return str_replace(["https://","http://"],"",$domain);
    }

    public function get_token()
    {
        $url = $this->get_env("API_UPLOAD_URL");
        $curl = new Curl($url);
        $curl->add_post("user",$this->get_env("API_UPLOAD_USERNAME"));
        $curl->add_post("password",$this->get_env("API_UPLOAD_PASSWORD"));
        $curl->add_post("remoteip",$_SERVER["REMOTE_ADDR"]);
        $curl->add_post("remotehost",$this->_get_origin());
        $curl->request_post();
        $r = $curl->get_response();
        //$this->logd($r,"get_token raw response");
        $r = \json_decode($r,1);
        $this->logd($r,"curl.upload.r");
        return $r["data"]["token"] ?? "";
    }
}
