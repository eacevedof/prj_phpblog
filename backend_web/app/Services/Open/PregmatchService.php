<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name PregmatchService
 * @file PregmatchService.php
 * @version 1.0.0
 * @date 23-11-2020 20:46
 * @observations
 */
namespace App\Services\Open;

use App\Services\BaseService;

class PregmatchService extends BaseService
{
    private $input;
    private $clean;
    private $errors;

    public function __construct($input=[])
    {
        $this->input = $input;
        $this->_load_clean();
    }

    private function _load_clean()
    {
        $this->clean = [
            "pattern" => $this->input["pattern"] ?? "",
            "flags"    => $this->input["flags"] ?? "",
            "text"    => $this->input["text"] ?? "",
        ];
    }

    private function _get_matches()
    {
        $pattern = $this->clean["pattern"];
        $flags = $this->clean["flags"];
        $pattern = "#$pattern#$flags";
        $text = $this->clean["text"];

        preg_match_all($pattern, $text, $result);
        return $result;
    }

    public function get()
    {
        $r = $this->_get_matches();
        $r = print_r($r,1);
        return $r;
    }
}
