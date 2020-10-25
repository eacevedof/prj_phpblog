<?php
namespace App\Http\Controllers\Restrict\Language;

use App\Http\Controllers\BaseController;
use App\Services\Restrict\Language\Sentence\SentenceDetailService;

class SentencetrController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(){return view('restrict.language.sentencetr.index',["module"=>"sentencetr"]);}

    public function insert($idsentence){
        $idsubject = (new SentenceDetailService($idsentence))->get_id_subject();
        return view(
            'restrict.language.sentencetr.insert',[
            "module"=>"sentencetr",
            "idsubject"=>$idsubject,
            "idsentence"=>$idsentence
        ]);
    }

    public function update($idsentence,$idsentencetr){
        return view('restrict.language.sentencetr.update',[
            "module"=>"sentencetr",
            "idsubject"=>$idsentence,
            "idsentencetr"=>$idsentencetr,
        ]);
    }

    public function detail(){return view('restrict.language.sentencetr.detail',["module"=>"sentencetr"]);}

}
