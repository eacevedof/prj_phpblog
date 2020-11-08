<?php
namespace App\Services\Restrict\Language\Sentencetop;
use App\Models\Language\AppSentenceTop;
use App\Services\BaseService;

class SentencetopInsertService extends BaseService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    private function _exists()
    {
        return AppSentenceTop::where("id_sentence","=",$this->data["id_sentence"]??"")
            ->where("id_language","=",$this->data["id_language"]??"")
            ->exists();
    }

    private function _check_data() {
        if($this->_exists()) throw new \Exception("This language already exists");
    }

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data);
        $this->logd($data,"sentencetop.insert.create");
        $r = AppSentenceTop::create($data);
        $this->_logquery("sentencetop.insert.save");
        return $r;
    }
}
