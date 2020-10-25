<?php
namespace App\Services\Restrict\Language\Sentencetr;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SentencetrIndexService extends BaseService
{
    private $table;

    public function __construct()
    {
        $this->table = $this->get_table("app_sentencetr");
    }

    public function get_active()
    {
        $r = $this->table
            ->whereNull("delete_date")
            ->where("id_status","=","1")
            ->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->get();
        $this->_logquery("sentencetrindexservice.get_active");
        return $r;
    }

    public function get_all()
    {
        $r = $this->table
            ->whereNull("delete_date")
            //->where("id_status","=","1")
            //->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->get();
        $this->_logquery("sentencetrindexservice.get_all");
        return $r;
    }
}
