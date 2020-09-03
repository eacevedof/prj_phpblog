<?php
namespace App\Services\Restrict\Post;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;

class PostDeleteService extends BaseService
{
    private $id;
    private $iduser;

    public function __construct($id, $iduser)
    {
        $this->id = $id;
        $this->iduser = $iduser;
    }

    private function _check_data()
    {

    }

    private function _soft_delete()
    {
        //$this->logd("soft delete");
        //$date = date("YmoHis");
        $datetime = date("Y-m-d H:i:s");
        return AppPost::where("id", "=", $this->id)->update(["delete_date"=>$datetime, "delete_user"=>$this->iduser]);
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
