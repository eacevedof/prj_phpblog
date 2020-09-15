<?php
namespace App\Services\Restrict\Post;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;

class PostDeleteService extends BaseService
{
    private $id;

    public function __construct($id, $iduser=-1)
    {
        $this->id = $id;
        $this->sysuser = $iduser;
    }

    private function _check_data()
    {

    }

    private function _soft_delete()
    {
        $update = [];
        $this->_handle_sysfields($update,"d");
        return AppPost::where("id", "=", $this->id)->update($update);
    }

    private function _hard_delete()
    {
        return AppPost::where("id", "=", $this->id)->delete();
    }

    public function save()
    {
        $this->_check_data();
        return $this->_soft_delete();
    }
}
