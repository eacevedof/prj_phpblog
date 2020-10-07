<?php
namespace App\Http\Controllers\Open;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;

class LanguageController extends BaseController
{

    public function __invoke()
    {
        return view('open.home.contact', [
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.home.contact"),
            "breadscrumb" => $this->_get_scrumb("open.home.contact"),
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "contact",
        ]);
    }
}
