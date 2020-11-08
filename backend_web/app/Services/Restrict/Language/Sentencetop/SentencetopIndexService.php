<?php
namespace App\Services\Restrict\Language\Sentencetop;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SentencetopIndexService extends BaseService
{
    private $table;

    public function __construct()
    {
        $this->table = $this->get_table("app_sentence_tops");
    }

    public function get_active()
    {
        $r = $this->table
            ->whereNull("delete_date")
            ->where("id_status","=","1")
            ->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->get();
        $this->_logquery("sentencetopindexservice.get_active");
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
        $this->_logquery("sentencetopindexservice.get_all");
        return $r;
    }

    public function get_by_sentence($idsentence)
    {
        $idsentence = (int) $idsentence;
        $q = "
        SELECT
        tr.delete_date, tr.is_enabled,
        tr.id, tr.description, tr.translated, tr.id_language, tr.id_sentence,
        s.translatable as ff_sentence, l.code_erp as ff_language

        FROM app_sentence_tr tr
        LEFT JOIN app_sentence s
        ON tr.id_sentence = s.id
        LEFT JOIN app_language l
        ON tr.id_language = l.id

        WHERE 1
        AND tr.is_enabled='1'
        AND tr.delete_date IS NULL
        AND tr.id_sentence=$idsentence
        ";
        $r = DB::select($q);
        return $r;
    }
}
