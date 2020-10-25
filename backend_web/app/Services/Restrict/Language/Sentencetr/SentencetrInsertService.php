<?php
namespace App\Services\Restrict\Language\Sentencetr;
use App\Models\Language\AppSentenceTr;
use App\Services\BaseService;

class SentencetrInsertService extends BaseService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    private function _check_data($data) {}

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data);
        $this->logd($data,"sentencetr.insert.create");
        $r = AppSentenceTr::create($data);
        $this->_logquery("sentencetr.insert.save");
        return $r;
    }
}
