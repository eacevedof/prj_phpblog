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
    public function category($catslug)
    {
        return view('open.blog.index', ["category"=>$catslug]);
    }

    public function detail($catslug,$postslug)
    {
        return view('open.blog.detail', ["category"=>$catslug,"postslug"=>$postslug, "seo"]);
    }
}
