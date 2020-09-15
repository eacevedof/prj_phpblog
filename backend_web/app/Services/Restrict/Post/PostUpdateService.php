<?php
namespace App\Services\Restrict\Post;
use App\Component\Formatter;
use App\Models\AppPost;
use App\Services\BaseService;

class PostUpdateService extends BaseService
{
    private $dbentity;
    private $data;

    public function __construct( $data)
    {
        $this->data = $data;
        $this->dbentity = AppPost::find($data["id"]);
        //$this->logd($this->dbentity,"DBENTITY");
    }

    private function _check_data($data)
    {

    }

    private function _set_publishdate(&$data)
    {
        $this->logd("db.pubdate:{$this->dbentity->publish_date}, db.id_status:{$this->dbentity->id_status},  dat.idstatus:{$this->data["id_status"]}","_set_publishdate");
        if(!$this->dbentity->publish_date && !$this->dbentity->id_status && $this->data["id_status"]){
            $this->logd("gen publishdate");
            $data["publish_date"] = date("Y-m-d H:i:s");
        }
    }

    private function _set_lastupdate(&$data)
    {
        if($this->dbentity->publish_date && $this->data["id_status"]){
            $data["last_update"] = date("Y-m-d H:i:s");
        }
    }

    private function _set_seo(&$data){
        if(!$this->dbentity->seo_title & !$this->data["seo_title"])
            $data["seo_title"] = substr($this->data["title"],0,64);

        if(!$this->dbentity->seo_description & !$this->data["seo_description"])
            $data["seo_description"] = substr($this->data["content"],0,159);
    }

    private function _format_date(&$data)
    {
        $fields = ["publish_date","last_update"];
        foreach ($fields as $field){
            $datetime = $data[$field];
            $ardate = Formatter::get_datetime($datetime);
            $data[$field] = $ardate["ymdhis"] ?? null;
        }
    }

    public function save()
    {
        $data = $this->data;
        $this->logd($data,"post.update");
        $this->_check_data($data);
        //$this->logd($this->request->input("description"),"input.description");
        //$this->logd($this->request->all(),"updateservice.save.req-all");
        //$this->logd($this->request->getContent(),"updateservice.save.req-getcontent");
        $this->clean_sysfields($data);
        $this->_format_date($data);
        $this->_set_publishdate($data);
        $this->_set_lastupdate($data);
        $this->_set_seo($data);

        $this->logd($data,"post.update.update");
        $id = $this->data["id"];
        return AppPost::where("id", "=", $id)->update($data);
    }
}
