<?php
namespace App\Services\Common\Category;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class CategoryService extends BaseService
{
    private $qb;

    public function __construct()
    {
        //DB::enableQueryLog();
        $this->qb = DB::table("app_array");
    }

    public function get($slug)
    {
        $r = $this->qb->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("type","=","post")
            ->where("slug","=",$slug)
            ->limit(1)
            ->get();

        return $r;
    }

    public function get_submenu_blog()
    {
        $r = $this->qb->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("type","=","submenu-blog")
            ->orderBy("order_by")
            ->orderBy("description")
            ->get();

        $this->log($this->qb->toSql(),"get_submenu_blog");
        $this->log($this->qb->getBindings(), "get_blogsmenu.bindings");
        return $r;
    }

    public function get_by_post()
    {
        $r = $this->qb->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("type","=","post")
            ->orderBy("order_by")
            ->orderBy("description")
            ->get();

        $this->log($this->qb->toSql(),"get_submenu_blog");
        $this->log($this->qb->getBindings(), "get_blogsmenu.bindings");
        return $r;
    }

    public function get_by_id($id)
    {
        $r = $this->qb->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("id","=",$id)
            //->orderBy("order_by")
            //->orderBy("description")
            ->get();

        $this->log($this->qb->toSql(),"get_by_id");
        $this->log($this->qb->getBindings(), "get_by_id.bindings");
        return $r;
    }
}
