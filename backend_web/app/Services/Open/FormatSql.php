<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name FormatSql
 * @file PrettyQueryService.php
 * @version 1.0.0
 * @date 23-11-2020 20:46
 * @observations
 */
namespace App\Services\Open;

use App\Services\BaseService;

class FormatSql extends BaseService
{
    private $input;
    private $clean;
    private $temp = [];

    public function __construct($input=[])
    {
        $this->input = $input;
        $this->_load_clean();
    }

    private function _load_clean()
    {
        $this->clean = [
            "query" => $this->_get_sanitized($this->input["query"] ?? ""),
        ];
    }
    private function _get_sanitized($sql)
    {
        if(!$sql) return "";
        $sql = trim($sql);
        $sql = strtolower($sql);
        $sql = str_replace("\n"," ",$sql);
        $sql = str_replace("\r"," ",$sql);
        $sql = str_replace("    "," ",$sql);
        $sql = str_replace("   "," ",$sql);
        $sql = str_replace("  "," ",$sql);
        return $sql;
    }

    private function _explode_select()
    {
        $sql = $this->clean["query"];
        $parts = explode(" from ",$sql);


        $this->temp["fields"] = explode($parts[0];
        $this->temp["post-from"] = $parts[1];
        return $this;
    }

    private function _explode_from()
    {
        $sql = $this->clean["query"];
        $parts = explode("from ",$sql);
        $this->temp["pre-from"] = $parts[0];
        $this->temp["post-from"] = $parts[1];
        return $this;
    }

    private function _explode_inner()
    {
        $str = $this->temp[1] ?? "";
        if(!$str) return $this;
        $parts = explode("INNER JOIN ",$str);
        $this->temp["pre-join"] = $parts[0];
        $this->temp["post-join"] = $parts[1];
        return $this;
    }

    private function _has_part($part, $sql)
    {
        if($part=="distinct")//ok
            return strstr($sql,"select distinct ");
        elseif($part=="top")
            return strstr($sql," top ");
        elseif($part=="where")
            return strstr($sql," where ");
        elseif($part=="groupby")
            return strstr($sql," group by ");
        elseif($part=="having")
            return strstr($sql," having ");
        elseif($part=="orderby")
            return strstr($sql," order by ");
        return false;
    }

    private function _get_select()
    {

    }

    private function _get_top($sql)
    {
        //puede ser select top o select distinct top
        $sTopPatern = "/select[\s]+top[\s]+[\d]+[\s]/";
        preg_match($sTopPatern,$sql,$arMatch);
        //si no hay coincidencias es probable que haya un distinct asi que se extrae con distinct
        if(!$arMatch[0])
        {
            $sTopPatern = "/select[\s]+distinct[\s]+top[\s]+[\d]+[\s]/";
            preg_match($sTopPatern,$sql,$arMatch);
        }

        if($arMatch[0])
        {
            $sTop = explode_select("top",$arMatch[0]);
            $sTop = trim($sTop[1]);
        }

        return $sTop;
    }

    private function _explode_query()
    {
        $sql = $this->clean["query"];
        $sql = $this->_get_sanitized($sql);

        $didstinct = $this->_has_part("distinct", $sql);
        $top = $this->_has_part("top", $sql);


    }

    private function _get_formatted()
    {
        $r = $this->_explode_from()->_get_select();


        return $r;
    }

    public function get()
    {
        $r = $this->_get_formatted();
        return $r;
    }
}
