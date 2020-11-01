<?php
namespace App\Services\Restrict\Language\Sentencetr;
use App\Models\Language\AppSentenceTr;
use App\Services\BaseService;

class SentencetrUpdateService extends BaseService
{
    private $dbentity;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->dbentity = AppSentenceTr::find($data["id"]);
    }

    private function _check_data($data){}

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data,"u");

        $id = $this->data["id"];
        $r = AppSentenceTr::where("id", "=", $id)->update($data);

        $this->_logquery("update");
        return $r;
    }
}
