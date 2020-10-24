<?php
namespace App\Http\Controllers\Restrict\Language;

use App\Http\Controllers\BaseController;

class SentenceController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(){return view('restrict.language.sentence.index',["module"=>"sentence"]);}

    public function insert($idsubject){
        return view(
            'restrict.language.sentence.insert',[
            "module"=>"sentence",
            "idsubject"=>$idsubject
        ]);
    }

    public function update($idsentence){
        return view('restrict.language.sentence.update',[
            "module"=>"sentence",
            "idsentence"=>$idsentence
        ]);
    }

    public function detail(){return view('restrict.language.sentence.detail',["module"=>"sentence"]);}

    public function sentences($idsentence){
        return view('restrict.language.sentence.sentences',[
            "module"=>"sentence",
            "idsentence"=>$idsentence,
        ]);
    }
}
