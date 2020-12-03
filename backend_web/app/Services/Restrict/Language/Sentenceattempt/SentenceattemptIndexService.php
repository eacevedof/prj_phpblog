<?php
namespace App\Services\Restrict\Language\Sentenceattempt;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SentenceattemptIndexService extends BaseService
{
    private $table;

    public function __construct()
    {
        $this->table = $this->get_table("app_sentence_attempt");
    }

    public function get_active()
    {
        $r = $this->table
            ->whereNull("delete_date")
            ->where("id_status","=","1")
            ->where("is_enabled","=","1")
            ->orderBy("id","desc")
            ->get();
        $this->_logquery("sentenceattemptindexservice.get_active");
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
        $this->_logquery("sentenceattemptindexservice.get_all");
        return $r;
    }

    public function get_by_subject($idsubject)
    {
        $idsubject = (int) $idsubject;
        $q = "
        -- iresult: 0:nok, 1:ok, 2:skip
        SELECT id_sentence, iresult, count(mt.id) as m_id
        FROM app_sentence_attempts mt
        INNER JOIN app_sentence_tr str
        ON mt.id_sentence_tr = str.id
        INNER JOIN app_sentence `s`
        ON str.id_sentence = `s`.id
        WHERE 1
        -- AND mt.id_user = 1
        AND s.id_subject = $idsubject
        GROUP BY id_sentence, iresult

        UNION

        -- las que nunca han aparecido
        SELECT DISTINCT none.id_sentence, 0 iresult, 9999 as m_id
        FROM app_sentence s
        INNER JOIN
        (
            -- las que no tienen ningún intento
            SELECT tr.id_sentence, 0 iresult, 9999 as m_id
            FROM app_sentence_tr tr
            LEFT JOIN app_sentence_attempts a
            ON tr.id = a.id_sentence_tr
            WHERE 1
            AND a.id IS NULL
        ) AS none
        ON s.id = none.id_sentence
        AND s.id_subject = $idsubject

        ORDER BY iresult, m_id DESC, id_sentence
        ";
        $r = DB::select($q);
        return $r;
    }
}
