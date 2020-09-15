<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name App\Traits\SysfieldsTrait
 * @file SysfieldsTrait.php 1.0.0
 * @date 15-09-2020 10:00 SPAIN
 * @observations
 */
namespace App\Traits;

trait SysfieldsTrait
{
    protected $sysuser = -1;
    /**
     * string|null $processflag
     * string|null $insert_platform
     * string|null $insert_user
     * timestamp $insert_date
     * string|null $update_platform
     * string|null $update_user
     * timestamp|null $update_date
     * string|null $delete_platform
     * string|null $delete_user
     * timestamp|null $delete_date
     * string|null $cru_csvnote
     * string|null $is_erpsent
     * string|null $is_enabled
     * int|null $i
     * string|null $code_cache
     */

    private function _get_platform()
    {
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

    private function _unset_operations(&$data,$operations = [])
    {
        foreach ($operations as $operation) {
            unset($data["{$operation}_user"], $data["{$operation}_date"], $data["{$operation}_platform"]);
        }
    }

    private function _set_userplat(&$data,$operation="insert")
    {
        $data["{$operation}_user"] = $this->sysuser;
        $data["{$operation}_platform"] = $this->_get_platform();
    }

    protected function _handle_sysfields(array &$data, $op="i")
    {
        /*
        $date = ["insert_date","update_date","delete_date"];
        $user = ["insert_user","insert_date","insert_user"];
        $flags = ["is_erpsent","is_enabled","processflag"];
        $auto = ["cru_csvnote, code_cache"];
        */

        unset($data["_action"],$data["_token"]);
        if($op==="i"){
            $this->_unset_operations($data, ["update","delete"]);
            $this->_set_userplat($data);
            if(isset($data["code_cache"]) && !$data["code_cache"]) $data["code_cache"] = \uniqid();
            unset($data["insert_date"]);
        }
        elseif ($op==="u") {
            $this->_unset_operations($data, ["insert","delete"]);
            $this->_set_userplat($data,"update");
            if(isset($data["code_cache"]) && !$data["code_cache"]) $data["code_cache"] = \uniqid();
            unset($data["update_date"]);
        }
        else{
            $data = [];
            $this->_set_userplat($data,"delete");
            //mantengo la fecha de modificacion
            $data["update_date"] = date("YmdHis",strtotime($data["update_date"]));
            $data["delete_date"] = date("YmdHis");
        }
    }
}//SysfieldsTrait
