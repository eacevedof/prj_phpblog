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

    private function _check_data() {

    }

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data);
        $r = AppSentenceAttempt::create($data);
        $this->_logquery("sentenceattempt.insert.save");
        return $r;
    }
}
