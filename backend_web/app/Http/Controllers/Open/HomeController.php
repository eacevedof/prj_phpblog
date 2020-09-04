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
        $r = (new PostIndexService())->get_top10();
        $seo = SeoComponent::get_meta("home");
        return view('open.home.index',["result"=>$r,"seo"=>$seo]);
    }
}
