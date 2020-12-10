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

    private const FUNC_NAMES = ["count(","max(","min(","trim(","sum(","coalesce(","concat(","char(","cast(","abs("];

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
        if($val = ($this->splitted["fields"] ?? ""))
        {
            $ar = array_merge(["select "," distinct "," top "," as ","case when"," then "," else "," end "],self::FUNC_NAMES);
            $tmp = $this->_get_uppered($ar, $val);
            $tmp = $this->_get_nlined([","], $tmp,false);
            $this->qparts["fields"] = $tmp;
        }
        return $this;
    }

    private function _explode_from()
    {
        if($val = ($this->splitted["from"] ?? ""))
        {
            $tmp = $this->_get_uppered([" as "], $val);
            $this->qparts["from"] = "\nFROM $tmp";
        }
        return $this;
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
        if($val = ($this->splitted["joins"] ?? ""))
        {
            //dd($val);
            $tmp = $this->_get_uppered(["inner join"," left join "," right join "," cross join "," on "," and "," like "], $val);
            $tmp = $this->_get_uppered(["join "], $tmp);
            $tmp = $this->_get_nlined(["INNER JOIN ","LEFT JOIN ","RIGHT JOIN ","CROSS JOIN ","ON ","AND "], $tmp);
            $this->qparts["joins"] = $tmp;
        }
        return $this;
    }

    private function _explode_where()
    {
        $val = $this->splitted["where"] ?? "";
        if($val)
        {
            $tmp = $this->_get_uppered([" and "," or "," in "], $val);
            $tmp = $this->_get_nlined(["AND ","OR "], $tmp);
            $this->qparts["where"] = "\nWHERE $tmp";
        }
        return $this;
    }

    private function _explode_groupby()
    {
        if($val = ($this->splitted["group by"] ?? ""))
        {
            $ar = array_merge([" and "," or "," as ","case when"," then "," else "," end "], self::FUNC_NAMES);
            $tmp = $this->_get_uppered($ar, $val);
            $tmp = $this->_get_nlined(["AND ","OR "], $tmp);
            $tmp = $this->_get_nlined([","], $tmp,0);
            $this->qparts["group by"] = "\nGROUP BY $tmp";
        }
        return $this;
    }

    private function _explode_having()
    {
        if($val = ($this->splitted["having"] ?? ""))
        {
            $ar = array_merge([" and "," or "," as ","case when"," then "," end "], self::FUNC_NAMES);
            $tmp = $this->_get_uppered($ar, $val);
            $tmp = $this->_get_nlined(["AND ","OR "], $tmp);
            $tmp = $this->_get_nlined([","], $tmp,0);
            $this->qparts["having"] = "\nHAVING $tmp";
        }
        return $this;
    }

    private function _explode_orderby()
    {
        if($val = ($this->splitted["order by"] ?? ""))
        {
            $ar = array_merge([" and "," or "," as ","case when"," then "," end "," desc"," asc"], self::FUNC_NAMES);
            $tmp = $this->_get_uppered($ar, $val);
            $tmp = $this->_get_nlined(["AND ","OR "], $tmp);
            $tmp = $this->_get_nlined([","], $tmp,0);
            $this->qparts["order by"] = "\nORDER BY $tmp";
        }
        return $this;
    }

    private function _explode_limit()
    {
        if($val = ($this->splitted["limit"] ?? ""))
        {
            $this->qparts["limit"] = "\nLIMIT $val";
        }
        return $this;
    }

    private function _explode_offset()
    {
        $val = ($this->splitted["offset"] ?? "");
        if($val!=="")
        {
            $this->qparts["offset"] = "\nOFFSET $val";
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

        $tmp = $this->_get_exploded(" offset ",$sql);
        if($tmp) {
            $sql = $tmp[0];
            $parts["offset"] = $tmp[1];
        }

        $tmp = $this->_get_exploded("limit ",$sql);
        if($tmp) {
            $sql = $tmp[0];
            $parts["limit"] = $tmp[1];
        }

        $tmp = $this->_get_exploded("order by ",$sql);
        if($tmp) {
            $sql = $tmp[0];
            $parts["order by"] = $tmp[1];
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

        $tmp = $this->_get_exploded(" from ",$sql);

        if($tmp) {
            //dd($tmp);
            $sql = trim($tmp[1]);
            $parts["fields"] = $tmp[0];

            $tmp = explode(" ",$sql);
            $parts["from"] = $tmp[0];
        }

        //dd($parts);
        $tmp = $this->_get_matches("/((join|inner join|left join|cross join|right join))(.*)/", $sql);
        if($tmp) {
            $parts["joins"] = $tmp[0][0] ?? "";
        }
        return $parts;
    }

    private function _get_query()
    {
        $query = implode("\n", $this->qparts);
        return $query;
    }

    private function _get_formatted()
    {
        $this->splitted = $this->_get_splitted();
        //dd($this->splitted);
        $r = $this->_explode_select()
            ->_explode_from()
            ->_explode_joins()
            ->_explode_where()
            ->_explode_groupby()
            ->_explode_having()
            ->_explode_orderby()
            ->_explode_limit()
            ->_explode_offset()
            ->_get_query();
        return $r;
    }

    public function get()
    {
        $r = $this->_get_formatted();
        return $r;
    }
}
