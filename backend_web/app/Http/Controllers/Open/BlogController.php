<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\BaseController;
use App\Services\Restrict\Post\PostDetailService;

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

    private function _error_404($collection)
    {
        if($collection->isEmpty()) abort(404);
    }

    public function detail($catslug,$postslug)
    {
        $r = (new PostDetailService())->get_by_slug($postslug);
        $this->_error_404($r);

        $post = $r->first();
        $seo=[
            "title" => $post->seo_title,
            "description" => $post->seo_description,
            "keywords" => "",
        ];

        $breadscrumb = $this->_get_scrumb("open.blog.detail");
        return view('open.blog.detail', ["post"=>$post, "seo"=>$seo, "breadscrumb"=>$breadscrumb]);
    }
}
