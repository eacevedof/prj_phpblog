<?php
namespace App\Http\Controllers\Open;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Open\PdftojpgService;

class ServiceController extends BaseController
{
    //servicios/pdf-a-jpg
    public function pdf_to_jpg()
    {
        $serv = new PdftojpgService(null);
        return view('open.service.pdftojpg',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.pdftojpg"),
            "breadscrumb" => $this->_get_scrumb("open.service.pdftojpg"),
            "catslug"     => "service"
        ]);
    }
}
