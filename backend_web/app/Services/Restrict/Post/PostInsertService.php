<?php
namespace App\Services\Restrict\Post;
use App\Component\Formatter;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;

class PostInsertService extends BaseService
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
            if(!is_string($datetime)) continue;
            $ardate = Formatter::get_datetime($datetime);
            $data[$field] = $ardate["ymdhis"] ?? null;
        }
    }

    private function _format_ispage(&$data)
    {
        $ispage = $data["is_page"][0] ?? "0";
        $data["is_page"] = $ispage;
    }

    public function save()
    {
        $data = $this->request->all();
        $this->logd($data,"post.insert");
        $this->_check_data($data);
        $this->clean_sysfields($data);
        $this->_format_date($data);
        $this->_format_ispage($data);
        $this->logd($data,"post.insert.create");
        return AppPost::create($data);
    }
}
