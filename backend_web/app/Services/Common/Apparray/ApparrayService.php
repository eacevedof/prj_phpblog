<?php
namespace App\Services\Common\Apparray;
use App\Services\BaseService;

class ApparrayService extends BaseService
{
    private $table;

    public function __construct()
    {
        $this->table = $this->get_table("app_array");
    }

    public function get_source()
    {
        $r = $this->table->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("type","=","source")
            ->orderBy("order_by")
            ->orderBy("description")
            ->get();
        return $r;
    }

}
