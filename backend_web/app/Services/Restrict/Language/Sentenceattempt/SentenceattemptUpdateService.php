<?php
namespace App\Services\Restrict\Language\Sentenceattempt;
use App\Models\Language\AppSentenceAttempt;
use App\Services\BaseService;

class SentenceattemptUpdateService extends BaseService
{
    private $dbentity;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->dbentity = AppSentenceAttempt::find($data["id"]);
    }

    private function _check_data($data){}

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data,"u");

        $id = $this->data["id"];
        $r = AppSentenceAttempt::where("id", "=", $id)->update($data);

        $this->_logquery("update");
        return $r;
    }
}
