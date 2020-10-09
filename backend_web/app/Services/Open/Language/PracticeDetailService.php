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

    private $data;

    public function __construct(string $subjslug)
    {
        $this->subjslug = $subjslug;
    }

    private function _get_subject()
    {
        //dd($slug);
        $table = $this->get_table("app_subject");
        $r = $table->whereNull("delete_date")
            ->where("is_enabled","=","1")
            ->where("id_status","=","1")
            ->where("slug","=","$this->slug")
            ->limit(1)
            ->get();
        return $r;
    }

    private function _get_sentences()
    {
        //dd($slug);
        $table = $this->get_table("app_sentence");
        $r = $table->whereNull("delete_date")
            ->where("is_enabled","=",1)
            ->where("id_status","=",1)
            ->where("id_subject","=",$this->idsubject)
            ->get();
        return $r;
    }

    private function _get_sentence_images()
    {
        $sentences = $this->data["sentences"];
        $ids = array_map(function($item){
            return $item->id;
        },$sentences);
        $table = $this->get_table("app_sentence_images");
        $r = $table->whereNull("delete_date")
            ->where("is_enabled","=",1)
            ->where("id_status","=",1)
            ->whereIn("id_sentence", $ids)
            ->get();
        return $r;
    }


    public function get()
    {
        $this->_check_data();

        $r = $this->_get_subject();
        if(!$r->id) throw new \Exception("No subject found");
        $this->idsubject = $r->id;
        $this->data["subject"] = $r;

        $r = $this->_get_sentences();
        $this->data["sentences"] = $r;

        $r = $this->_get_sentence_images();
        $this->data["sentence_images"] = $r;




    }
}
