<?php
namespace App\Http\Controllers\Open;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Restrict\Post\PostIndexService;

class HomeController extends BaseController
{
    public function __invoke()
    {
        $serv = new PostIndexService();
        $breadscrumb = $this->_get_scrumb("open.home.index");
        $canonical = $this->_get_canonical($breadscrumb ?? []);

        return view('open.home.index',[
            "result"      => $serv->get_top09(),
            "seo"         => SeoComponent::get_meta("open.home.index"),
            "breadscrumb" => $breadscrumb,
            "canonical"   => $canonical,
            "updatedat"   => $serv->get_maxdate(),
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "home",
        ]);
    }
}
