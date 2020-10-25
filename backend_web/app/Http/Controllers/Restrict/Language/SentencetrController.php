<?php
namespace App\Http\Controllers\Restrict\Language;

use App\Http\Controllers\BaseController;

class SentencetrController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(){return view('restrict.language.sentencetr.index',["module"=>"sentencetr"]);}

    public function insert($idsubject){
        return view(
            'restrict.language.sentencetr.insert',[
            "module"=>"sentencetr",
            "idsubject"=>$idsubject
        ]);
    }

    public function update($idsubject,$idsentencetr){
        return view('restrict.language.sentencetr.update',[
            "module"=>"sentencetr",
            "idsubject"=>$idsubject,
            "idsentencetr"=>$idsentencetr,
        ]);
    }

    public function detail(){return view('restrict.language.sentencetr.detail',["module"=>"sentencetr"]);}

}
