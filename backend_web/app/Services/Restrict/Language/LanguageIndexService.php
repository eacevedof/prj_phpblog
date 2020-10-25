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
            ->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->get();
        $this->_logquery("languageindexservice.getall");
        return $r;
    }
}
