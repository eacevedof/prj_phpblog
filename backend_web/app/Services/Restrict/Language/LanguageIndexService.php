<?php
namespace App\Services\Restrict\Language;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class LanguageIndexService extends BaseService
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
        //$this->entity = new AppLanguageSeeder();
        //return AppLanguageSeeder::where("user_id",auth()->id())->get();
        //return AppLanguageSeeder::where("user_id",$this->iduser);
        //dump(AppLanguageSeeder::all());
        //return AppLanguageSeeder::all()->sortByDesc("id");;
        $r = $this->qb->whereNull("delete_date")->orderBy("id","desc")->get();
        //$this->logd($r,"order by??");
        return $r;
    }

    public function get_all()
    {
        $r = $this->qb->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("id_status","=","1")
            ->orderBy("id","desc")
            ->get();
        return $r;
    }

    public function get_list_by_category($idcategory)
    {
        $r = $this->qb->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("id_status","=","1")
            ->where("id_type","=",$idcategory)
            ->orderBy("id","desc")
            ->get()
        ;
        $this->logd($r,"order by??");
        return $r;
    }

    public function get_top09()
    {
        $r = $this->qb->whereNull("delete_date")
            ->whereNotNull("id_status")
            ->where("is_enabled","=","1")
            ->where("id_status","=","1")
            ->orderBy("id","desc")
            ->limit(9)
            ->get();
        $this->logd($r,"get_top09");
        return $r;
    }

    public function get_maxdate()
    {
        $r = $this->qb->max("update_date");
        $this->logd($r,"get_maxdate");
        return $r;
    }

}
