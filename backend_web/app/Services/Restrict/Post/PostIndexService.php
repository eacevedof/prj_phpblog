<?php
namespace App\Services\Restrict\Post;
use App\Models\AppPost;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostIndexService extends BaseService
{
    private $entity;
    private $iduser;

    public function __construct($iduser=null)
    {
        $this->iduser = $iduser;
    }

    public function get_list_by_user()
    {
        //$this->entity = new AppPostSeeder();
        //return AppPostSeeder::where("user_id",auth()->id())->get();
        //return AppPostSeeder::where("user_id",$this->iduser);
        //dump(AppPostSeeder::all());
        //return AppPostSeeder::all()->sortByDesc("id");;
        $r = DB::table("app_post")->whereNull("delete_date")->orderBy("id","desc")->get();
        //$this->logd($r,"order by??");
        return $r;
    }


}
