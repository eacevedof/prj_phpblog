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
        $parts = explode("select ",$parts[0]);
        $parts = trim($parts[1] ?? "");

        $this->temp["fields"] = explode(",",$parts);
        return $this;
    }


    private function _get_query()
    {
        return implode("\n", $this->temp);
    }

    private function _get_formatted()
    {
        $r = $this->_explode_select()->_get_query();
        return $r;
    }

    public function get()
    {
        $r = $this->_get_formatted();
        return $r;
    }
}
