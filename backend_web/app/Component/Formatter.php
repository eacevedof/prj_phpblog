<?php

namespace App\Component;

class Formatter
{
    public static function get_datetime($datetime){
        if(!$datetime) return [];

        $result = [];
        //2020-10-04T00:00:00.000000Z
        //dump($datetime);die;
        if(strstr($datetime,"-") && strstr($datetime,"T") && strstr($datetime,".")){

            list($date,$time) = explode("T", $datetime);
            list($y,$m,$d) = explode("-", $date);
            list($h,$i,$s) = explode(":", explode(".",$time)[0]);

            $result = [
                "date" => $date,
                "y" => $y, "m" => $m, "d" => $d,
                "time" => $time,
                "h" => $h, "i" => $i, "s" => $s,
                "ymdhis" => "$y$m$d$h$i$s",
            ];
            //dump($datetime);dump($result);die;
        }
        elseif(strstr($datetime,"-") && !strstr($datetime,":")) {
            list($y,$m,$d) = explode("-", $datetime);

            $result = [
                "date" => $datetime,
                "y" => $y, "m" => $m, "d" => $d,
                "time" => "000000",
                "h" => "0", "i" => "0", "s" => "0",
                "ymdhis" => "$y$m$d"."000000",
            ];
        }
        return $result;
    }
}
