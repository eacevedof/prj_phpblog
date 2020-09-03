<?php
namespace App\Services\Restrict\Post;
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

    private function _check_data()
    {

    }

    public function save()
    {
        $this->_check_data();
        //$this->logd($this->request->input("description"),"input.description");
        //$this->logd($this->request->all(),"updateservice.save.req-all");
        //$this->logd($this->request->getContent(),"updateservice.save.req-getcontent");
        $data = $this->request->all();
        $this->clean_sysfields($data);
        return AppPost::where("id", "=", $this->request->input("id"))->update($data);
    }
}
