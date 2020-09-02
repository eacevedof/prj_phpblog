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
        return AppPost::where("id", "=", $this->request->name("id"))->update($this->request->all());
    }
}
