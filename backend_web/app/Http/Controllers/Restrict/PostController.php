<?php
namespace App\Http\Controllers\Restrict;

use App\Http\Controllers\BaseController;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(){return view('restrict.post.index',["module"=>"post"]);}

    public function insert(){return view('restrict.post.insert',["module"=>"post"]);}

    public function update(){return view('restrict.post.update',["module"=>"post"]);}

    public function detail(){return view('restrict.post.detail',["module"=>"post"]);}
}
