<?php
namespace App\Http\Controllers\Open;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Open\PdftojpgService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ServiceController extends BaseController
{
    //servicios/pdf-a-jpg
    public function pdftojpg()
    {
        //vista vue
        return view('open.service.pdftojpg',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.pdftojpg"),
            "breadscrumb" => $this->_get_scrumb("open.service.pdftojpg"),
            "catslug"     => "service"
        ]);
    }

    //servicios/pdf-a-jpg/convert
    public function pdftojpg_convert(Request $request)
    {
        $file = [
            "tmp_name" => $request->file("pdf")->getPathname()
        ];
        $serv = new PdftojpgService($file);
        return Response()->json(["download"=>$serv->get()]);
    }

}
