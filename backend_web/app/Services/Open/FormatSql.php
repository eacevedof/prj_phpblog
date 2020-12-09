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
    private $qparts = [];
    private $splitted = [];
    private $temp;

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
        if($this->splitted["fields"])
        {
            $tmp = $this->_get_uppered(["select","distinct","top"], $this->splitted["fields"]);
            $tmp = $this->_get_nlined([","], $tmp,false);
            $this->qparts["fields"] = $tmp;
        }
        return $this;
    }

    private function _explode_from()
    {
        $val = $this->splitted["from"] ?? "";
        if($val)
        {
            $tmp = $this->_get_uppered(["select","distinct","top"], $val);
            $tmp = $this->_get_nlined([","], $tmp,false);
            $this->qparts["from"] = $tmp;
        }
        return $this;
    }

    private function _get_inner_text($pattern, $text)
    {
        $matches = $this->_get_matches($pattern,$text);
        return $matches[1][0] ?? "";
    }

    private function _get_matches($pattern, $text)
    {
        preg_match_all($pattern, $text, $matches);
        return $matches;
    }

    private function _get_uppered($artoup, $text)
    {
        $uppers = [];
        foreach ($artoup as $up)
            $uppers[] = strtoupper($up);
        return str_replace($artoup, $uppers, $text);
    }

    private function _get_nlined($armark, $text, $prev=1)
    {
        $nls = [];
        foreach ($armark as $str)
        {
            $str = ltrim($str);
            if($prev)
                $nls[] = "\n$str";
            else
                $nls[] = "$str\n";
        }
        return str_replace($armark, $nls, $text);
    }

    private function _explode_joins()
    {
        $val = $this->splitted["joins"] ?? "";
        if($val)
        {
            $tmp = $this->_get_uppered(["inner join","left join","right join","cross join"," on "], $val);
            $tmp = $this->_get_nlined(["INNER ","LEFT ","RIGHT ","CROSS "," ON "], $tmp);
            $this->qparts["from"] = "\nFROM $tmp";
        }
        return $this;
    }

    private function _explode_where()
    {
        $val = $this->splitted["where"] ?? "";
        if($val)
        {
            $tmp = $this->_get_uppered(["and","or"," in "], $val);
            $tmp = $this->_get_nlined(["AND","OR"], $tmp);
            $this->qparts["where"] = "\nWHERE $tmp";
        }
        return $this;
    }

    private function _explode_groupby()
    {
        $val = $this->splitted["group by"] ?? "";
        if($val)
        {
            $this->qparts["group by"] = "\nGROUP BY $val";
        }
        return $this;
    }

    private function _explode_having()
    {
        $val = $this->splitted["having"] ?? "";
        if($val)
        {
            $this->qparts["having"] = "\nHAVING $val";
        }
        return $this;
    }

    private function _explode_limit()
    {
        $val = $this->splitted["limit"] ?? "";
        if($val)
        {
            $this->qparts["limit"] = "\nLIMIT $val";
        }
        return $this;
    }

    private function _get_exploded($sep, $sql)
    {
        if(strstr($sql,$sep))
        {
            return explode($sep, $sql);
        }
        return [];
    }

    private function _get_splitted()
    {
        $parts = [];
        $sql = $this->clean["query"];
        $tmp = $this->_get_exploded("limit ",$sql);
        if($tmp) {
            $sql = $tmp[0];
            $parts["limit"] = $tmp[1];
        }

        $tmp = $this->_get_exploded("having ",$sql);
        if($tmp) {
            $sql = $tmp[0];
            $parts["having"] = $tmp[1];
        }

        $tmp = $this->_get_exploded("group by ",$sql);
        if($tmp) {
            $sql = $tmp[0];
            $parts["group by"] = $tmp[1];
        }

        $tmp = $this->_get_exploded("where ",$sql);
        if($tmp) {
            $sql = $tmp[0];
            $parts["where"] = $tmp[1];
        }

        $tmp = $this->_get_exploded("from ",$sql);
        if($tmp) {
            $sql = trim($tmp[1]);
            $parts["fields"] = $tmp[0];

            $tmp = explode(" ",$sql);
            $parts["from"] = $tmp[0];
        }

        $tmp = $this->_get_matches("/((inner|left|cross|right)[\s]+join)(.*)/", $sql);
        if($tmp) {

            $parts["joins"] = $tmp[0][0] ?? "";
        }
        return $parts;
    }

    private function _get_query()
    {
        //dd($this->qparts);
        $query = implode("\n", $this->qparts);
        //$query = $this->_get_uppered(["inner join","left join","right join","cross join"," on "],$query);
        return $query;
    }

    private function _get_formatted()
    {
        $this->splitted = $this->_get_splitted();
        $r = $this->_explode_select()
            ->_explode_from()
            ->_explode_joins()
            ->_explode_where()
            ->_explode_groupby()
            ->_explode_having()
            ->_explode_limit()
            ->_get_query();
        return $r;
    }

    public function get()
    {
        $r = $this->_get_formatted();
        return $r;
    }
}
