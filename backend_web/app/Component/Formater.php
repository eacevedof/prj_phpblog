<?php
namespace App\Component;

class Formatter
{
    public static function get_datetime($datetime){
        $result = [];

        //2020-09-03T09:12:51.000000Z
        if(strstr($datetime,"-") && strstr($datetime,"M") && strstr($datetime,".")){
            list($date,$time) = explode("T",$datetime);
            list($y,$m,$d) = explode("-",$date);
            list($h,$i,$s) = explode(":", explode(".",$time)[0]);

            $result = [
                "date" => $date,
                "y" => $y, "m" => $m, "d" => $d,
                "time" => $time,
                "h" => $h, "i" => $i, "s" => $s,
                "ymdhis" => "$y$m$d$h$i$s",
            ];
        }
        return $result;
    }
}
