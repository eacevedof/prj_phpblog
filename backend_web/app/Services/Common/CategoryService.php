<?php
namespace App\Services\Restrict\Post;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class Category extends BaseService
{
    private $qb;

    public function __construct()
    {
        $this->qb = DB::table("app_");
    }

    public function get_by_slug($slug)
    {
        $r = $this->qb->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("id_status","=","1")
            ->where("slug","=",$slug)
            ->limit(1)
            ->get();

        return $r;
    }
}
