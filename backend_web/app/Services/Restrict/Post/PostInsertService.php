<?php
namespace App\Services\Restrict\Post;
use App\Component\Formatter;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;

class PostInsertService extends BaseService
{
    private $iduser;
    private $data;

    public function __construct($data, $iduser=null)
    {
        $this->iduser = $iduser;
        $this->data = $data;
    }

    private function _check_data($data)
    {

    }

    private function _remove_dates(&$data)
    {
        $fields = ["publish_date", "last_update"];
        foreach ($fields as $field)
            unset($data[$field]);
    }

    private function _format_ispage(&$data)
    {
        $ispage = $data["is_page"][0] ?? "0";
        $data["is_page"] = $ispage;
    }

    public function save()
    {
        $data = $this->data;
        $this->logd($data,"post.insert");
        $this->_check_data($data);
        $this->clean_sysfields($data);
        $this->_remove_dates($data);
        $this->_format_ispage($data);
        $this->logd($data,"post.insert.create");
        return AppPost::create($data);
    }
}
