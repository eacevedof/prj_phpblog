<?php
namespace App\Http\Controllers\Open;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Restrict\Language\Subject\SubjectIndexService;

class LanguageController extends BaseController
{

    public function __invoke()
    {
        $r = (new SubjectIndexService())->get_all();
        return view('open.language.index', [
            "result"      => $r,
            "seo"         => SeoComponent::get_meta("open.language.index"),
            "breadscrumb" => $this->_get_scrumb("open.language.index"),
            //"submenublog" => $this->_get_submenu_blog(),
            //"submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "language",
        ]);
    }

    public function practice()
    {
        return view('open.language.practice', [
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.language.practice"),
            "breadscrumb" => $this->_get_scrumb("open.language.practice"),
            //"submenublog" => $this->_get_submenu_blog(),
            //"submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "language",
        ]);
    }
}
