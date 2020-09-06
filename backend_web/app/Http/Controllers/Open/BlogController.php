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
        return view('open.blog.index', [
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.blog.index"),
            "breadscrumb" => $this->_get_scrumb("open.blog.index"),
            "submenublog" => $this->_get_submenu_blog(),
            "catslug"     => "blog",
        ]);
    }

    public function category($catslug)
    {
        $category = $this->_get_category($catslug);
        $repconfig = ["category"=>$catslug,"categorytext"=>$category->description];

        return view('open.blog.index', [
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.blog.category.{$catslug}"),
            "breadscrumb" => $this->_get_scrumb("open.blog.category", $repconfig),
            "submenublog" => $this->_get_submenu_blog(),
            "catslug"     => "blog",
        ]);
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

        return view('open.blog.index', [
            "result"      => [],
            "post"        => $post,
            "seo"         => $seo,
            "breadscrumb" => $this->_get_scrumb("open.blog.detail", $repconfig),
            "submenublog" => $this->_get_submenu_blog(),
            "catslug"     => "blog",
        ]);
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
