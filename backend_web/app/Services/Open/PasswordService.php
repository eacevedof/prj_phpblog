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
        echo "k:$key, r:$r - ";
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
        $str = "!.\"|@#$%&()=?'¿¡º[*]+{ç}<>,;:.-_";
        //$str = utf8_decode($str);
        $cons = $this->_get_random($str);
        return $cons;
    }

    private function _get_boolean(){return (rand(0,1)==1);}

    public function get($ilen=8)
    {
        $password = [];
        for($i=0; $i<$ilen; $i++){
            $islower = $this->_get_boolean();
            if($i==0 || $i==($ilen-1)) $password[] = $this->_get_wierd();
            elseif($i%2==0)
                $password[] = $this->_get_consonant($islower);
            elseif($i%3==0)
                $password[] = $this->_get_vowel($islower);
            else
                $password[] = $this->_get_number();
        }

        $r = implode("",$password);
        //dump($r);
        echo "<br/>";
        print_r($r);die;
        return $r;
    }
}
