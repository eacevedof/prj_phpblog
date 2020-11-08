<?php
namespace App\Services\Restrict\Language\Sentencetop;
use App\Models\Language\AppSentenceTop;
use App\Services\BaseService;

class SentencetopUpdateService extends BaseService
{
    private $dbentity;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->dbentity = AppSentenceTop::find($data["id"]);
    }

    private function _check_data($data){}

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data,"u");

        $id = $this->data["id"];
        $r = AppSentenceTop::where("id", "=", $id)->update($data);

        $this->_logquery("update");
        return $r;
    }
}
