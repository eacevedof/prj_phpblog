<?php
namespace App\Services\Restrict\Post;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //return AppPost::where("user_id",$this->iduser);
        //dump(AppPost::all());
        //return AppPost::all()->sortByDesc("id");;
        $r = DB::table("app_post")->orderBy("id","desc")->get();
        //$this->logd($r,"order by??");
        return $r;
    }


}
