<?php
namespace App\Services\Restrict\Language\Sentencetr;
use App\Models\Language\AppSentenceTr;
use App\Services\BaseService;


class SentencetrDeleteService extends BaseService
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    private function _check_data(){}

    private function _soft_delete()
    {
        $sentencetr = AppSentenceTr::find($this->id);
        $update = ["update_date"=>$sentencetr->update_date];
        $this->_handle_sysfields($update,"d");
        $r = AppSentenceTr::where("id", "=", $this->id)->update($update);
        $this->_logquery("soft_delete");
        return $r;
    }

    private function _hard_delete()
    {
        return AppSentenceTr::where("id", "=", $this->id)->delete();
    }

    public function save()
    {
        $this->_check_data();
        return $this->_soft_delete();
    }
}
