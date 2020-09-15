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
        return 3;
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

        if($op==="i"){
            $this->_unset_operations($data, ["update","delete"]);
            $this->_set_userplat($data);
            if(isset($data["code_cache"]) && !$data["code_cache"]) $data["code_cache"] = \uniqid();
        }
        elseif ($op==="u") {
            $this->_unset_operations($data, ["insert","delete"]);
            $this->_set_userplat($data,"update");
            if(isset($data["code_cache"]) && !$data["code_cache"]) $data["code_cache"] = \uniqid();
        }
        else{
            $this->_unset_operations($data, ["insert","update"]);
            $this->_set_userplat($data,"delete");
            $data["delete_date"] = date("YmdHis");
        }
    }
}//SysfieldsTrait
