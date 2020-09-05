<?php
namespace App\Http\Controllers\Open;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Common\Category\CategoryService;
use App\Services\Restrict\Post\PostDetailService;

class BlogController extends BaseController
{
    public function __invoke()
    {
        $breadscrumb = $this->_get_scrumb("open.blog.index");
        $seo = SeoComponent::get_meta("open.blog.index");
        return view('open.blog.index', ["result"=>[], "seo"=>$seo, "breadscrumb"=>$breadscrumb]);
    }

    public function category($catslug)
    {
        $category = $this->_get_category($catslug);
        $repconfig = ["category"=>$catslug,"categorytext"=>$category->description];
        $breadscrumb = $this->_get_scrumb("open.blog.category", $repconfig);
        $seo = SeoComponent::get_meta("open.blog.category.{$catslug}");
        return view('open.blog.index', ["result"=>[], "seo"=>$seo, "breadscrumb"=>$breadscrumb]);
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

        $category = $this->_get_category($catslug);
        $repconfig = ["category"=>$catslug,"categorytext"=>$category->description,"slug"=>$postslug,"slugtext"=>$post->title];
        $breadscrumb = $this->_get_scrumb("open.blog.detail", $repconfig);
        return view('open.blog.detail', ["post"=>$post, "seo"=>$seo, "breadscrumb"=>$breadscrumb]);
    }

    private function _error_404($collection)
    {
        if($collection->isEmpty()) abort(404);
    }

    private function _get_category($slug)
    {
        $r = (new CategoryService())->get($slug);
        if($r->isEmpty())  abort(404);
        return $r->first();
    }
}
