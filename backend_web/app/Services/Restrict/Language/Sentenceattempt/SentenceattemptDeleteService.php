<?php
namespace App\Services\Restrict\Language\Sentenceattempt;
use App\Models\Language\AppSentenceAttempt;
use App\Services\BaseService;


class SentenceattemptDeleteService extends BaseService
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    private function _check_data(){}

    private function _soft_delete()
    {
        $sentenceattempt = AppSentenceAttempt::find($this->id);
        $update = ["update_date"=>$sentenceattempt->update_date];
        $this->_handle_sysfields($update,"d");
        $r = AppSentenceAttempt::where("id", "=", $this->id)->update($update);
        $this->_logquery("soft_delete");
        return $r;
    }

    private function _hard_delete()
    {
        return AppSentenceAttempt::where("id", "=", $this->id)->delete();
    }

    public function save()
    {
        $this->_check_data();
        return $this->_soft_delete();
    }
}
