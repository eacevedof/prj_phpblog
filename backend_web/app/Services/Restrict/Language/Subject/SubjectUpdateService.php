<?php
namespace App\Services\Restrict\Subject;
use App\Models\AppSubject;
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

    private function _set_publishdate(&$data)
    {
        if(!$this->dbentity->publish_date && !$this->dbentity->id_status && $this->data["id_status"]){
            $data["publish_date"] = date("YmdHis");
        }
        else
            //evita que se rescriba la fecha con lo que viene de js
            unset($data["publish_date"]);
    }

    private function _set_lastupdate(&$data)
    {
        if($this->dbentity->publish_date &&
            $this->data["id_status"] &&
            $this->dbentity->content != $this->data["content"]){

            $data["last_update"] = date("YmdHis");
        }
    }

    private function _set_seo(&$data){
        if(!$this->dbentity->seo_title & !$this->data["seo_title"])
            $data["seo_title"] = substr(strip_tags($this->data["title"]),0,64);

        if(!$this->dbentity->seo_description & !$this->data["seo_description"])
            $data["seo_description"] = substr(strip_tags($this->data["excerpt"]),0,159);
    }

    public function save()
    {
        $data = $this->data;
        $this->logd($data,"post.update");
        $this->_check_data($data);
        //$this->logd($this->request->input("description"),"input.description");
        //$this->logd($this->request->all(),"updateservice.save.req-all");
        //$this->logd($this->request->getContent(),"updateservice.save.req-getcontent");
        $this->_handle_sysfields($data,"u");
        $this->_set_publishdate($data);
        $this->_set_lastupdate($data);
        $this->_set_seo($data);

        $this->logd($data,"post.update.data");
        $id = $this->data["id"];
        return AppSubject::where("id", "=", $id)->update($data);
    }
}
