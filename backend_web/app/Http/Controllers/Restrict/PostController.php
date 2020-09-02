<?php
namespace App\Http\Controllers\Restrict;

use App\Http\Controllers\BaseController;
use App\Services\Restrict\Post\PostDetailService;
use Illuminate\Support\Facades\Auth;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(){return view('restrict.post.index');}

    public function insert(){return view('restrict.post.insert');}

    public function update(){return view('restrict.post.update');}

    public function detail($idpost)
    {
        $iduser = Auth::id();
        $post = (new PostDetailService($idpost, $iduser))->get();
        return view('restrict.post.detail',["post"=>$post]);
    }
}
