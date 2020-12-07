<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name PrettyQueryService
 * @file PrettyQueryService.php
 * @version 1.0.0
 * @date 23-11-2020 20:46
 * @observations
 */
namespace App\Services\Open;

use App\Services\BaseService;

class PrettyQueryService extends BaseService
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
            "query" => $this->input["query"] ?? "",
        ];
    }

    private function _get_matches()
    {

    }

    public function get()
    {
        $r = $this->_get_matches();
        $r = print_r($r,1);
        return $r;
    }
}
