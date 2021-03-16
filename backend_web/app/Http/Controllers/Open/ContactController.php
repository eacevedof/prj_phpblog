<?php
namespace App\Http\Controllers\Open;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Restrict\Post\PostIndexService;

class ContactController extends BaseController
{

    public function __invoke()
    {
        $breadscrumb = $this->_get_scrumb("open.home.contact");
        $canonical = $this->_get_canonical($breadscrumb);

        return view('open.home.contact', [
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.home.contact"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "contact",
        ]);
    }
}
