<?php
namespace App\Http\Controllers\Open;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Open\PasswordService;
use App\Services\Open\PdftojpgService;
use Illuminate\Http\Request;

class ServiceController extends BaseController
{
    //servicios/convertir-pdf-a-jpg
    public function pdftojpg()
    {
        //vista vue
        return view('open.service.pdftojpg',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.pdftojpg"),
            "breadscrumb" => $this->_get_scrumb("open.service.pdftojpg",["slug"=>"convertir-pdf-a-jpg","slugtext"=>"Convertir PDF a JPG"]),
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "service"
        ]);
    }

    //services/conversion/pdf-to-jpg (upload)
    public function pdftojpg_convert(Request $request)
    {
        $extension = $request->file("pdf")->getClientOriginalExtension();
        if(strtolower($extension)!=="pdf")
            return Response()->json(["error"=>"El archivo debe ser de tipo PDF"]);

        $file = [
            "tmp_name" => $request->file("pdf")->getPathname()
        ];
        $urldownload = (new PdftojpgService($file))->get();
        //$urldownload = "";
        $r["download"] = $urldownload;
        if(!$urldownload) $r["error"] = "El archivo no se ha podido convertir";
        return Response()->json($r);
    }

    //servicios/generar-password
    public function generatepassword()
    {
        $r = (new PasswordService())->get(10);
        return Response()->json($r);
    }
}
