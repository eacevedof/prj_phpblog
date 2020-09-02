<?php
namespace App\Services\Restrict\Post;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;

class PostDeleteService extends BaseService
{
    private $id;

    public function __construct($id, $iduser)
    {
        $this->iduser = $iduser;
        $this->id = $id;
    }

    private function _check_data()
    {

    }

    public function save()
    {
        $this->_check_data();
        return AppPost::where("id", "=", $this->id)->delete();
    }
}
