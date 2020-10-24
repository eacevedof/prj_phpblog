<?php
namespace App\Services\Restrict\Language\Sentence;
use App\Models\Language\AppSentence;
use App\Services\BaseService;

class SentenceUpdateService extends BaseService
{
    private $dbentity;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->dbentity = AppSentence::find($data["id"]);
    }

    private function _check_data($data){}

    private function _set_seo(&$data){
        if(!$this->dbentity->seo_title & !$this->data["seo_title"])
            $data["seo_title"] = substr(strip_tags($this->data["title"]),0,64);

        if(!$this->dbentity->seo_description & !$this->data["seo_description"])
            $data["seo_description"] = substr(strip_tags($this->data["excerpt"]),0,159);
    }

    public function save()
    {
        $data = $this->data;
        $this->_check_data($data);
        $this->_handle_sysfields($data,"u");
        $this->_set_seo($data);

        $this->logd($data,"sentence.update.data");
        $id = $this->data["id"];

        $this->logd($data,"before update");
        $r = AppSentence::where("id", "=", $id)->update($data);

        $this->_logquery("update");
        return $r;
    }
}
