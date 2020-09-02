<?php
namespace App\Services\Restrict\Post;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;

class PostDetailService extends BaseService
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

    public function save()
    {
        $this->_check_data();
        return AppPost::find($this->id);
    }
}
