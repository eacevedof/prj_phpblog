<?php
namespace App\Services\Restrict\Language\Subject;
use App\Models\Language\AppSubject;
use App\Services\BaseService;

class SubjectUpdateService extends BaseService
{
    private $dbentity;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->dbentity = AppSubject::find($data["id"]);
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

        $this->logd($data,"subject.update.data");
        $id = $this->data["id"];

        $this->logd($data,"before update");
        $r = AppSubject::where("id", "=", $id)->update($data);

        $this->_logquery("update");
        return $r;
    }
}
