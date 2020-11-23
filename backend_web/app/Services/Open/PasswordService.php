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
        dump($ar);
        return $ar[$key];
    }

    private function _get_vowel($islower=true)
    {
        $str = "aeiou";
        $vowel = $this->_get_random($str);
        if(!$islower) return strtoupper($vowel);
        return $vowel;
    }

    private function _get_consonant($islower=true)
    {
        $str = "bcdfghjklmnñpqrstvwxyz";
        $cons = $this->_get_random($str);
        if(!$islower) return strtoupper($cons);
        return $cons;
    }

    private function _get_wierd($islower=true)
    {
        $str = "!.\"|@#$%&()=?'¿¡º[*+]{ç}<>;,:.-_";
        $cons = $this->_get_random($str);
        if(!$islower) return strtoupper($cons);
        return $cons;
    }

    private function _get_boolean(){return (rand(0,1)==1);}

    public function get($ilen=8)
    {
        $password = [];
        for($i=0; $i<$ilen; $i++){
            $islower = $this->_get_boolean();
            $password[] = $this->_get_consonant($islower);
            $password[] = $this->_get_vowel($islower);
            $password[] = $this->_get_wierd($islower);
        }

        $r = implode("=",$password);
        //dd($r);
        return $r;
    }
}
