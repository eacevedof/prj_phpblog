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
    private function _get_random($str)
    {
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
        $vowel = $this->_get_random($str);
        if(!$islower) return strtoupper($vowel);
        return $vowel;
    }

    private function _get_number()
    {
        $str = "0123456789";
        $number = $this->_get_random($str);
        return $number;
    }

    private function _get_consonant($islower=true)
    {
        $str = "bcdfghjklmnpqrstvwxyz";
        $cons = $this->_get_random($str);
        if(!$islower) return strtoupper($cons);
        return $cons;
    }

    private function _get_wierd()
    {
        $str = "!.|@#$%&=?'+*()[]{}<>,;:.-_";
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
        return implode(",",$r);
    }

    public function get($ilen=8)
    {
        $password = [];
        $half = floor($ilen/2);
        $rest = $ilen - $half - 2;
        if($rest<0) $rest = 0;

        $startcons = $this->_get_boolean();
        $password[] = $this->_get_word($half, $startcons);

        if($rest)

        $r = implode("",$password);
        //dump($r);
        //echo "<br/>";
        //print_r($r);die;
        return $r;
    }
}
