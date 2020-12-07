<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name PasswordService
 * @file PasswordService.php
 * @version 1.0.0
 * @date 23-11-2020 20:46
 * @observations
 */
namespace App\Services\Open;

use App\Services\BaseService;

class PasswordService extends BaseService
{
    private $input;
    private $clean;

    public function __construct($input=[])
    {
        $this->input = $input;
        $this->_load_clean();
    }

    private function _load_clean()
    {
        $this->clean = [
            "length"   => $this->input["length"] ?? 8,
            "chars"    => $this->_get_as_array($this->input["nochars"]),
            "numbers"  => $this->_get_as_array($this->input["nonumbers"]),
            "letters"  => $this->_get_as_array($this->input["noletters"]),
        ];
    }

    private function _get_as_array($str)
    {
        if(!$str) return [];
        $r = str_split($str);
        $r = array_map(function($str){return trim($str);},$r);
        $r = array_filter($r, function($str){return $str!=="";});
        $r = array_unique($r);
        return $r;
    }

    private function _get_exclude_applied($str,$exclude)
    {
        if($exclude)
            return str_replace($exclude,"",$str);
        return $str;
    }

    private function _get_random($str)
    {
        if(!$str) return "";
        $len = strlen($str);
        $ar = [];
        for($i=0; $i<$len; $i++)
            $ar[] = $str[$i];
        $key = array_rand($ar,1);
        $r = $ar[$key];
        //echo "k:$key, r:$r - ";
        return $r;
    }

    private function _get_vowel($islower=true)
    {
        $str = "aeiou";
        $str = $this->_get_exclude_applied($str,$this->clean["letters"]);
        $vowel = $this->_get_random($str);
        if(!$islower) return strtoupper($vowel);
        return $vowel;
    }

    private function _get_number()
    {
        $str = "0123456789";
        $str = $this->_get_exclude_applied($str,$this->clean["numbers"]);
        $number = $this->_get_random($str);
        return $number;
    }

    private function _get_consonant($islower=true)
    {
        $str = "bcdfghjklmnpqrstvwxyz";
        $str = $this->_get_exclude_applied($str,$this->clean["letters"]);
        $cons = $this->_get_random($str);
        if(!$islower) return strtoupper($cons);
        return $cons;
    }

    private function _get_wierd()
    {
        $str = "!.|@#$%&=?'+*()[]{}<>,;:.-_";
        $str = $this->_get_exclude_applied($str,$this->clean["chars"]);
        $cons = $this->_get_random($str);
        return $cons;
    }

    private function _get_boolean(){return (rand(0,1)==1);}

    private function _get_word($ilen=4, $consonant=true)
    {
        $r = [];
        for($i=0; $i<$ilen; $i++)
        {
            if($i%2===0) {
                if ($consonant) {
                    $islower = $this->_get_boolean();
                    $r[] = $this->_get_consonant($islower);
                }
                //vouwel
                else {
                    $islower = $this->_get_boolean();
                    $r[] = $this->_get_vowel($islower);
                }
            }
            //pos impar
            else {
                if ($consonant) {
                    $islower = $this->_get_boolean();
                    $r[] = $this->_get_vowel($islower);
                }
                //vowel
                else {
                    $islower = $this->_get_boolean();
                    $r[] = $this->_get_consonant($islower);
                }
            }
        }//for

        return implode("",$r);
    }//get_word

    private function _get_figure($ilen=2)
    {
        $r = [];
        for($i=0; $i<$ilen; $i++)
            $r[] = $this->_get_number();
        return implode("",$r);
    }

    public function get()
    {
        $ilen = $this->clean["length"];

        $password = [];
        $half = floor($ilen/2);
        $rest = $ilen - $half - 2;
        if($rest<0) $rest = 0;

        $startcons = $this->_get_boolean();
        $password[] = $this->_get_word($half, $startcons);
        $password[] = $this->_get_wierd();
        $password[] = $this->_get_figure($rest);
        $password[] = $this->_get_wierd();

        $r = implode("",$password);
        return trim($r);
    }
}
