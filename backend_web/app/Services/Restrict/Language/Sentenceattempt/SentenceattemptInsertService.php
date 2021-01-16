<?php
namespace App\Services\Restrict\Language\Sentenceattempt;
use App\Models\Language\AppSentenceAttempt;
use App\Services\BaseService;

class SentenceattemptInsertService extends BaseService
{
    private $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    private function _check_input()
    {
        $id = (integer) $this->input["id_sentence_tr"];
        if(!is_integer($id))
            throw new \Exception("Wrong sentence id provided: '{$this->input["id_sentence_tr"]}'");
    }

    public function save()
    {
        $input = $this->input;
        $this->_check_input();
        $this->_handle_sysfields($input);
        $r = AppSentenceAttempt::create($input);
        $this->_logquery("sentenceattempt.insert.save");
        return $r;
    }
}
