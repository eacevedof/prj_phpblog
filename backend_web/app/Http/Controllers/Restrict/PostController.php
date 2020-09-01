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
        if($request->input("action")=="insert")
        {
            $post = new AppPost();
            $post->description = $request->input("description");
            $post->save();
            return response('Hello World', 200)
                ->header('Content-Type', 'text/plain');
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
