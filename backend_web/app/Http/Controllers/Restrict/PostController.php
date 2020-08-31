<?php

namespace App\Http\Controllers\Restrict;

use App\Http\Controllers\BaseController;
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

    public function insert()
    {
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
