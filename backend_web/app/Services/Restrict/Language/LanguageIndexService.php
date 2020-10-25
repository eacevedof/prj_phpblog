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

    public function get_picklist()
    {
        $r = $this->table
            ->where("is_enabled","=","1")
            ->orderBy("language","asc")
            ->orderBy("id","asc")
            ->get(["delete_date","is_enabled","id","code_erp","description","translated","language","id_parent"]);
        $this->_logquery("languageindexservice.getpicklist");
        return $r;
    }
}
