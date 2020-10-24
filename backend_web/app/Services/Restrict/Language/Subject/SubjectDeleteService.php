<?php
namespace App\Services\Restrict\Language\Sentence;
use App\Models\Language\AppSentence;
use App\Services\BaseService;

class SentenceDeleteService extends BaseService
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    private function _check_data(){}

    private function _soft_delete()
    {
        $sentence = AppSentence::find($this->id);
        $update = ["update_date"=>$sentence->update_date];
        $this->_handle_sysfields($update,"d");
        $r = AppSentence::where("id", "=", $this->id)->update($update);
        $this->_logquery("soft_delete");
        return $r;
    }

    private function _hard_delete()
    {
        return AppSentence::where("id", "=", $this->id)->delete();
    }

    public function save()
    {
        $this->_check_data();
        return $this->_soft_delete();
    }
}
