<?php
namespace App\Http\Controllers\Restrict\Language;

use App\Http\Controllers\BaseController;

class SubjectController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(){return view('restrict.language.subject.index',["module"=>"subject"]);}

    public function insert(){return view('restrict.language.subject.insert',["module"=>"subject"]);}

    public function update($idsubject){

        return view('restrict.language.subject.update',[
            "module"=>"subject",
            "idsubject"=>$idsubject
        ]);
    }

    public function detail(){return view('restrict.language.subject.detail',["module"=>"subject"]);}
}
