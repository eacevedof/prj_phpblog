<?php
namespace App\Services\Restrict\Language\Sentencetop;
use App\Models\Language\AppSentenceTop;
use App\Services\BaseService;


class SentencetopDeleteService extends BaseService
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    private function _check_data(){}

    private function _soft_delete()
    {
        $sentencetop = AppSentenceTop::find($this->id);
        $update = ["update_date"=>$sentencetop->update_date];
        $this->_handle_sysfields($update,"d");
        $r = AppSentenceTop::where("id", "=", $this->id)->update($update);
        $this->_logquery("soft_delete");
        return $r;
    }

    private function _hard_delete()
    {
        return AppSentenceTop::where("id", "=", $this->id)->delete();
    }

    public function save()
    {
        $this->_check_data();
        return $this->_soft_delete();
    }
}
