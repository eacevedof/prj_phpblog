<?php
namespace App\Http\Controllers\Open;

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
        $serv = new PostIndexService();
        $r = $serv->get_top09();
        $seo = SeoComponent::get_meta("home");
        $breadscrumb = $this->_get_scrumb("open.home.index");
        $blogsubmenu = $this->_get_blogsubmenu();

        return view('open.home.index',[
            "result"=>$r,"seo"=>$seo,"breadscrumb"=>$breadscrumb,
            "updatedat"=>$serv->get_maxdate(),
            "blogsubmenu"=>$blogsubmenu
        ]);
    }
}
