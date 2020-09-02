<?php

namespace App\Http\Controllers\Restrict;

use App\Http\Controllers\BaseController;
use App\Models\AppPost;
use App\Services\Restrict\Post\PostDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(){return view('restrict.post.index');}

    public function insert(){return view('restrict.post.insert');}

    public function update()
    {
        //$iduser = Auth::id();
        //$post = (new PostDetailService($idpost, $iduser))->get();
        return view('restrict.post.update');
    }

    public function detail($idpost)
    {
        $iduser = Auth::id();
        $post = (new PostDetailService($idpost, $iduser))->get();
        return view('restrict.post.detail',["post"=>$post]);
    }

    //no procede esto se hace desde el listado
    /*
    private function delete($idpost)
    {
        return view('restrict.post.delete');
    }
    */
}
