<?php
namespace App\Http\Controllers\Open;

use App\Component\BreadComponent;
use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Restrict\Post\PostIndexService;

class HomeController extends BaseController
{
    /**
     * @return View
     */
    public function __invoke()
    {
        $r = (new PostIndexService())->get_top09();
        $seo = SeoComponent::get_meta("home");
        //$breadscrumb = (new BreadComponent())->get_items("open.home.index")->get();
        $breadscrumb = $this->_get_scrumb("open.home.index");
        //dd($breadscrumb);
        return view('open.home.index',["result"=>$r,"seo"=>$seo,"breadscrumb"=>$breadscrumb]);
    }
}
