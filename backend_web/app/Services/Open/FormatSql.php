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
            "query" => $this->input["query"] ?? "",
        ];
    }

    private function _explode_from()
    {
        $sql = $this->clean["query"];
        $parts = explode("FROM ",$sql);
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




    private function _get_select()
    {

    }

    private function _join()
    {

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
