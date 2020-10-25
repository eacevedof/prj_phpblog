<?php
namespace App\Services\Restrict\Language;
use App\Services\BaseService;

class LanguageIndexService extends BaseService
{
    private $table;

    public function __construct()
    {
        $this->table = $this->get_table("app_language");
    }

    public function get_all()
    {
        $r = $this->table
            ->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("id_status","=","1")
            ->orderBy("id","desc")
            ->get();
        $this->_logquery("languageindexservice.getall");
        return $r;
    }
}
