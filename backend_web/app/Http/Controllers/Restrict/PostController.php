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

    public function __invoke()
    {
        return view('restrict.post.index');
    }

    public function insert(Request $request)
    {
/*
        //print_r($_POST);print_r($_GET);die;
        $rules = [];
        if($request->isMethod('post')){
            if ($request->input("action") == "post.insert") {
                $post = new AppPost();
                $post->description = $request->input("description");
                $post->save();
                return response(json_encode(["title"=>'success',"description"=>"Post creado"]), 200)
                    ->header('Content-Type', 'application/json');
            }
            return response(json_encode(["title"=>"error","description"=>"Datos incorrectos enviados"]), 401)
                ->header('Content-Type', 'application/json');
        }
*/
        return view('restrict.post.insert');
    }

    public function update($idpost)
    {
        $iduser = Auth::id();
        $post = (new PostDetailService($idpost, $iduser))->get();
        return view('restrict.post.update',["post"=>$post]);
    }

    public function detail($idpost)
    {
        $iduser = Auth::id();
        $post = (new PostDetailService($idpost, $iduser))->get();
        return view('restrict.post.detail',["post"=>$post]);
    }

    public function delete($idpost)
    {
        return view('restrict.post.delete');
    }
}
