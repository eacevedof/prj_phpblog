<?php
namespace App\Services\Restrict\Language\Sentence;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class SentenceIndexService extends BaseService
{
    private $table;

    public function __construct()
    {
        $this->table = $this->get_table("app_sentence");
    }

    public function get_active()
    {
        $r = $this->table
            ->whereNull("delete_date")
            ->where("id_status","=","1")
            ->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->get();
        $this->_logquery("sentenceindexservice.get_active");
        return $r;
    }

    public function get_all2()
    {
        $r = $this->table
            ->whereNull("delete_date")
            //->where("id_status","=","1")
            //->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->get();
        $this->_logquery("sentenceindexservice.get_all");
        return $r;
    }

    public function get_all()
    {
        $q = "
        SELECT
        s.delete_date, s.is_enabled,
        s.id, s.id_context, s.id_language, s.id_status, s.id_subject, s.id_type, s.translatable, s.description,
        l.code_erp as ff_language,
        ar1.description as ff_context,
        ar2.description as ff_type
        FROM app_sentence s
        LEFT JOIN app_language l
        ON s.id_language = l.id
        LEFT JOIN app_array ar1
        ON s.id_context = ar1.id AND ar1.type = 'lang-context'
        LEFT JOIN app_array ar2
        ON s.id_type = ar2.id AND ar2.type = 'lang-type'
        WHERE 1
        AND s.is_enabled='1'
        AND s.delete_date IS NULL
        ORDER BY s.id DESC
        ";
        $r = DB::select($q);
        return $r;
    }

    public function get_by_subject($idsubject)
    {
        $idsubject = (int) $idsubject;
        $q = "
        SELECT
        s.delete_date, s.is_enabled,
        s.id, s.id_context, s.id_language, s.id_status, s.id_subject, s.id_type, s.translatable, s.description,
        sub.title ff_subject, l.code_erp as ff_language,
        ar1.description as ff_context,
        ar2.description as ff_type
        FROM app_sentence s
        LEFT JOIN app_subject sub
        ON s.id_subject = sub.id
        LEFT JOIN app_language l
        ON s.id_language = l.id
        LEFT JOIN app_array ar1
        ON s.id_context = ar1.id AND ar1.type = 'lang-context'
        LEFT JOIN app_array ar2
        ON s.id_type = ar2.id AND ar2.type = 'lang-type'
        WHERE 1
        AND s.is_enabled='1'
        AND s.delete_date IS NULL
        AND s.id_subject=$idsubject
        ORDER BY s.id DESC
        ";
        $r = DB::select($q);
        return $r;
    }
}
