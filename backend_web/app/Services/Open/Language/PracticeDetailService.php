<?php
namespace App\Services\Open\Language;
use App\Models\AppSubject;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

class PracticeDetailService extends BaseService
{
    private $subjslug;
    private $idsubject;
    private $sentenceids;
    private $data;

    public function __construct(string $subjslug)
    {
        $this->subjslug = $subjslug;
        $this->data = [
            "subject"=>[], "sentences"=>[], "sentence_images"=>[],
            "sentence_tags"=>[], "sentence_tr"=>[]
        ];
    }
    private function _load_sentenceids()
    {
        $sentences = [];
        array_push($sentences, ...$this->data["sentences"]);

        $this->sentenceids = array_map(function($item){
            return $item->id;
        },$sentences);

        //dd($this->sentenceids);
    }

    private function _get_subject()
    {
        //dd($slug);
        $table = $this->get_table("app_subject");
        $r = $table->whereNull("delete_date")
            ->where("is_enabled","=",1)
            ->where("id_status","=",1)
            ->where("slug","=","$this->subjslug")
            ->limit(1)
            ->get(["insert_date","update_date","delete_date","id","description","slug","url_final","url_img1",
                "title","excerpt","url_resource","id_type_source"]);
        $r = $r->first();
        return $r;
    }

    private function _get_sentences()
    {
        $table = $this->get_table("app_sentence");
        $r = $table->whereNull("delete_date")
            ->where("is_enabled","=",1)
            ->where("id_status","=",1)
            ->where("id_subject","=",$this->idsubject)
            ->get(["insert_date","update_date","delete_date","id","description","id_subject","id_context","translatable","id_language","id_type","id_status"]);
        return $r;
    }

    private function _get_sentence_trs()
    {
        $table = $this->get_table("app_sentence_tr");
        $r = $table->whereNull("delete_date")
            ->where("is_enabled","=",1)
            ->whereIn("id_sentence", $this->sentenceids)
            ->get(["insert_date","update_date","delete_date","id","description","translated","id_language","id_sentence"]);
        return $r;
    }

    private function _get_sentence_images()
    {
        $table = $this->get_table("app_sentence_images");
        $r = $table->whereNull("delete_date")
            ->where("is_enabled","=",1)
            ->whereIn("id_sentence", $this->sentenceids)
            ->get();
        return $r;
    }

    private function _get_sentence_tags()
    {
        $table = $this->get_table("app_sentence_tags");
        $r = $table->whereNull("delete_date")
            ->where("is_enabled","=",1)
            ->whereIn("id_sentence", $this->sentenceids)
            ->get();
        return $r;
    }

    private function _load_data()
    {
        $r = $this->_get_subject();
        if(!$r->id) throw new \Exception("No subject found");
        $this->idsubject = $r->id;
        $this->data["subject"] = $r;

        $r = $this->_get_sentences();
        $this->data["sentences"] = $r;

        $this->_load_sentenceids();
        if(!$this->sentenceids) return;

        $r = $this->_get_sentence_images();
        $this->data["sentence_images"] = $r;

        $r = $this->_get_sentence_tags();
        $this->data["sentence_tags"] = $r;

        $r = $this->_get_sentence_trs();
        $this->data["sentence_tr"] = $r;
    }

    public function get()
    {
        $this->_load_data();
        return $this->data;
    }
}
