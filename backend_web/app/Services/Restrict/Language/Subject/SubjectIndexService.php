<?php
namespace App\Services\Restrict\Language\Subject;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SubjectIndexService extends BaseService
{
    private $table;

    public function __construct()
    {
        $this->table = $this->get_table("app_subject");
    }

    public function get_all()
    {
        $r = $this->table
            ->whereNull("delete_date")
            ->where("id_status","=","1")
            ->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->get();
        return $r;
    }
}
