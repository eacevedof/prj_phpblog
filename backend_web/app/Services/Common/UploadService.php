<?php
namespace App\Services\Common;

use App\Component\FetchComponent as Fetch;
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

        $fetch = new Fetch($url);
        $fetch
            ->add_post("user", $this->get_env("API_UPLOAD_USERNAME"))
            ->add_post("password", $this->get_env("API_UPLOAD_PASSWORD"))
            ->add_post("remoteip", $_SERVER["REMOTE_ADDR"])
            ->add_post("remotehost", $this->_get_origin())
        ;

        $r = $fetch->get_array();
        $this->logd($r,"curl.upload.r");
        return $r["data"]["token"] ?? "";
    }

    public function get_rootendpoint()
    {
        if($this->is_envlocal())  return "http://localhost:4000";

        $url = $this->get_env("API_UPLOAD_URL");
        $urlinfo = parse_url($url);
        return $urlinfo['scheme']."://".$urlinfo['host'].(isset($urlinfo["port"]) ? ":{$urlinfo["port"]}":"");
    }
}
