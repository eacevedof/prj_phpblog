<?php
namespace App\Http\Controllers\Open;

use App\Component\EnlighterjsComponent;
use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Common\Category\CategoryService;
use App\Services\Restrict\Post\PostDetailService;
use App\Services\Restrict\Post\PostIndexService;
use Illuminate\Support\Facades\Auth;

class BlogController extends BaseController
{
    public function __invoke()
    {
        $r = (new PostIndexService())->get_all();
        return view('open.blog.index', [
            "result"      => $r,
            "seo"         => SeoComponent::get_meta("open.blog.index"),
            "breadscrumb" => $this->_get_scrumb("open.blog.index"),
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "blog",
        ]);
    }

    public function category($catslug)
    {
        $category = $this->_get_category($catslug);
        $repconfig = ["category"=>$catslug,"categorytext"=>$category->description];

        $r = (new PostIndexService())->get_list_by_category($category->id);
        return view('open.blog.category', [
            "result"      => $r,
            "seo"         => SeoComponent::get_meta("open.blog.category.{$catslug}"),
            "breadscrumb" => $this->_get_scrumb("open.blog.category", $repconfig),
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "blog",
            "category"    => $category->description,
        ]);
    }

    public function detail($catslug, $postslug)
    {
        //dd($postslug);
        $category = $this->_get_category($catslug);
        $r = (new PostDetailService())->get_by_slug($postslug);
        $this->_error_404($r);

        $post = $r->first();
        $post->content = (new EnlighterjsComponent($post->content ?? ""))->get_cleaned();
        $seo=[
            "title" => $post->seo_title,
            "description" => $post->seo_description,
            "keywords" => "",
        ];

        $repconfig = ["category"=>$catslug,"categorytext"=>$category->description,"slug"=>$postslug,"slugtext"=>$post->title];

        return view('open.blog.detail', [
            "result"      => $post,
            //"post"        => ,
            "seo"         => $seo,
            "breadscrumb" => $this->_get_scrumb("open.blog.detail", $repconfig),
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "blog",
        ]);
    }

    //blog/draft/{id}
    public function detail_draft($id)
    {
        if(!Auth::id())
            abort(403,"Not authorized");
        //dd($postslug);
        $r = (new PostDetailService())->get_by_id($id);
        $this->_error_404($r);

        $post = $r->first();
        //dd($post);
        $post->content = (new EnlighterjsComponent($post->content ?? ""))->get_cleaned();
        $seo=[
            "title" => $post->seo_title,
            "description" => $post->seo_description,
            "keywords" => "",
        ];

        $repconfig = ["category"=>"draft","categorytext"=>"draft","slug"=>$post->slug,"slugtext"=>$post->title];

        return view('open.blog.detail', [
            "result"      => $post,
            "seo"         => $seo,
            "breadscrumb" => $this->_get_scrumb("open.blog.detail", $repconfig),
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "blog",
            "isdraft"     => true,
        ]);
    }

    private function _error_404($collection)
    {
        if($collection->isEmpty()) abort(404);
    }

    private function _get_category($slug)
    {
        //dd("catslug:$slug");
        $r = (new CategoryService())->get($slug);
        if($r->isEmpty())  abort(404);
        return $r->first();
    }
}
