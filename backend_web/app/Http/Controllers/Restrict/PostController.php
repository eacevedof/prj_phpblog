<?php

namespace App\Http\Controllers\Restrict;

use App\Http\Controllers\BaseController;
use App\Models\AppPost;
use Illuminate\Http\Request;

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

        return view('restrict.post.insert');
    }

    public function update($idpost)
    {
        return view('restrict.post.update');
    }

    public function detail($idpost)
    {
        return view('restrict.post.detail');
    }

    public function delete($idpost)
    {
        return view('restrict.post.delete');
    }
}
