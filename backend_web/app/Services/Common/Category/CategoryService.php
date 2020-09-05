<?php
namespace App\Services\Common\Category;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class CategoryService extends BaseService
{
    private $qb;

    public function __construct()
    {
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
}
