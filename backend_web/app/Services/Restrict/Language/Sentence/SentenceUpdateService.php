<?php
namespace App\Services\Restrict\Language\Sentence;
use App\Models\Language\AppSentence;
use App\Services\BaseService;

class SentenceUpdateService extends BaseService
{
    private $dbentity;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->dbentity = AppSentence::find($data["id"]);
    }

    private function _check_data($data){}

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data,"u");

        $id = $this->data["id"];

        $this->logd($data,"before update");
        $r = AppSentence::where("id", "=", $id)->update($data);

        $this->_logquery("update");
        return $r;
    }
}
