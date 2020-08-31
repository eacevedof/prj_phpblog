<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\BaseController;

class BlogController extends BaseController
{
    /**
     * @return View
     */
    public function __invoke()
    {
        return view('open.blog.index', ["category"=>""]);
    }

    public function category($slug)
    {
        return view('open.blog.index', ["category"=>$slug]);
    }
}
