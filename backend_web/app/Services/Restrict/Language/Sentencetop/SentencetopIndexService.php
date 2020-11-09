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

    public function get_by_subject($idsubject)
    {
        $idsubject = (int) $idsubject;
        $q = "
        SELECT id_sentence
        FROM app_sentence_tops mt
        INNER JOIN app_sentence `s`
        ON mt.id_sentence = `s`.id
        WHERE 1
        -- AND id_user = 1
        AND s.id_subject = $idsubject
        ";
        $r = DB::select($q);
        return $r;
    }
}
