<?php
namespace App\Services\Restrict\Post;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class PostIndexService extends BaseService
{
    private $iduser;
    private $qb;

    public function __construct($iduser=null)
    {
        $this->iduser = $iduser;
        $this->qb = DB::table("app_post");
    }

    public function get_list_by_user()
    {
        //$this->entity = new AppPostSeeder();
        //return AppPostSeeder::where("user_id",auth()->id())->get();
        //return AppPostSeeder::where("user_id",$this->iduser);
        //dump(AppPostSeeder::all());
        //return AppPostSeeder::all()->sortByDesc("id");;
        $r = $this->qb->whereNull("delete_date")->orderBy("id","desc")->get();
        //$this->logd($r,"order by??");
        return $r;
    }

    public function get_top10()
    {
        $r = $this->qb->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->limit(10)
            ->get();
        $this->logd($r,"get_top10");
        return $r;
    }

}
