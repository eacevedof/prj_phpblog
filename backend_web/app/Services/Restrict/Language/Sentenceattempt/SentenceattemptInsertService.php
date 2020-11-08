<?php
namespace App\Services\Restrict\Language\Sentenceattempt;
use App\Models\Language\AppSentenceAttempt;
use App\Services\BaseService;

class SentenceattemptInsertService extends BaseService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    private function _exists()
    {
        return AppSentenceAttempt::where("id_sentence","=",$this->data["id_sentence"]??"")
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
        $this->logd($data,"sentenceattempt.insert.create");
        $r = AppSentenceAttempt::create($data);
        $this->_logquery("sentenceattempt.insert.save");
        return $r;
    }
}
