<?php
namespace App\Services\Restrict\Post;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;

class PostListService extends BaseService
{
    private $entity;
    private $iduser;

    public function __construct($iduser=null)
    {
        $this->iduser = $iduser;
    }

    public function get_list_by_user()
    {
        //$this->entity = new AppPost();
        //return AppPost::where("user_id",auth()->id())->get();
        return AppPost::where("user_id",$this->iduser);
    }


}
