<?php
namespace App\Services\Restrict\Post;
use App\Component\Formatter;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;

class PostUpdateService extends BaseService
{
    private $iduser;

    public function __construct(Request $request, $iduser)
    {
        $this->iduser = $iduser;
        $this->request = $request;
    }

    private function _check_data($data)
    {

    }

    private function _format_date(&$data)
    {
        $fields = ["publish_date","last_update"];
        foreach ($fields as $field){
            $datetime = $data[$field];
            $ardate = Formatter::get_datetime($datetime);
            $data[$field] = $ardate["ymdhis"] ?? "";
        }
    }

    public function save()
    {
        $data = $this->request->all();
        $this->logd($data,"post.update");
        $this->_check_data($data);
        //$this->logd($this->request->input("description"),"input.description");
        //$this->logd($this->request->all(),"updateservice.save.req-all");
        //$this->logd($this->request->getContent(),"updateservice.save.req-getcontent");

        $this->clean_sysfields($data);
        $this->_format_date($data);

        $this->logd($data,"post.update.update");
        $id = $this->request->input("id");
        return AppPost::where("id", "=", $id)->update($data);
    }
}
