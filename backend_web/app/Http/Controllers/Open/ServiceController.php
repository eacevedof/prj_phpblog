<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Component\SeoComponent;

use App\Services\Open\FormatSqlService;
use App\Services\Open\PasswordService;
use App\Services\Open\PdftojpgService;
use App\Services\Open\PregmatchService;
use App\Services\Open\SslencryptService;
use App\Services\Open\SiteVulnerabilityService;

class ServiceController extends BaseController
{
    //servicios/convertir-pdf-a-jpg
    public function pdftojpg()
    {
        $breadscrumb = $this->_get_scrumb("open.service.pdftojpg",["slug"=>"convertir-pdf-a-jpg","slugtext"=>"Convertir PDF a JPG"]);
        $canonical = $this->_get_canonical($breadscrumb);

        //vista vue
        return view('open.service.pdftojpg',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.pdftojpg"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
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

    //api
    public function generate_password(Request $request)
    {
        $post = $request->all();
        $r = (new PasswordService($post))->get();
        return Response()->json(["data"=>$r]);
    }

    //servicios/generar-contrasena
    public function generatepassword(Request $request)
    {
        $breadscrumb = $this->_get_scrumb("open.service.generatepassword",["slug"=>"generar-contrasena","slugtext"=>"Genera una contraseña segura facil de recordar"]);
        $canonical = $this->_get_canonical($breadscrumb);

        return view('open.service.generatepassword',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.generatepassword"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "service"
        ]);
    }

    //api
    public function pregmatch_all(Request $request)
    {
        $post = $request->all();
        try {
            $r = (new PregmatchService($post))->get();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    //servicios/probar-php-pregmatch-all
    public function pregmatchall()
    {
        $breadscrumb = $this->_get_scrumb("open.service.pregmatchall",["slug"=>"generar-contrasena","slugtext"=>"Genera una contraseña segura facil de recordar"]);
        $canonical = $this->_get_canonical($breadscrumb);

        return view('open.service.pregmatchall',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.pregmatchall"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "service"
        ]);
    }

    //api
    public function format_sql(Request $request)
    {
        $post = $request->all();
        try {
            $r = (new FormatSqlService($post))->get();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    //servicios/formatear-sql-query
    public function formatsql()
    {
        $breadscrumb = $this->_get_scrumb("open.service.formatsql",["slug"=>"formatear-consulta-sql","slugtext"=>""]);
        $canonical = $this->_get_canonical($breadscrumb);

        return view('open.service.formatsql',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.formatsql"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "service"
        ]);
    }

    //servicios/reloj-alarma
    public function alarmclock()
    {
        $breadscrumb = $this->_get_scrumb("open.service.alarmclock",["slug"=>"reloj-alarma","slugtext"=>""]);
        $canonical = $this->_get_canonical($breadscrumb);

        return view('open.service.alarmclock',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.alarmclock"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "service"
        ]);
    }

    //api
    public function openssl_encrypt(Request $request)
    {
        $post = $request->all();
        try {
            $r = (new SslencryptService($post))->get();
            return Response()->json(["data"=>$r],200,[
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            ],JSON_UNESCAPED_UNICODE);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    //servicios/probar-openssl-encrypt
    public function opensslencrypt()
    {
        $breadscrumb = $this->_get_scrumb("open.service.opensslencrypt",["slug"=>"probar-openssl-encrypt","slugtext"=>"Prueba la función php openssl_encrypt"]);
        $canonical = $this->_get_canonical($breadscrumb);

        return view('open.service.opensslencrypt',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.opensslencrypt"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "service"
        ]);
    }

    //api
    public function site_vulnerability(Request $request)
    {
        $post = $request->all();
        try {
            $r = (new SiteVulnerabilityService($post))->get_test_result();
            return Response()->json(["data"=>$r],200,[
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            ],JSON_UNESCAPED_UNICODE);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    //servicios/comprueba-la-vulnerabilidad-de-tu-sitio-web
    public function sitevulnerability()
    {
        $breadscrumb = $this->_get_scrumb("open.service.sitevulnerability",[
            "slug"      => "comprueba-la-vulnerabilidad-de-tu-sitio-web",
            "slugtext"  => "Comprueba la vulnerabilidad de tu sitio web"
        ]);
        $canonical = $this->_get_canonical($breadscrumb);
        //$r = (new SiteVulnerabilityService())->get_top500();
        //echo "<pre>";print_r($r);
        return view('open.service.sitevulnerability',[
            "result"      => (new SiteVulnerabilityService())->get_top500(),
            "seo"         => SeoComponent::get_meta("open.service.sitevulnerability"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "service"
        ]);
    }

    //servicios/electronica/calculadora-ley-de-ohm
    public function ohmslaw()
    {
        $breadscrumb = $this->_get_scrumb("open.service.electronic.ohmslaw", ["slug"=>"calculadora-ley-de-ohm", "slugtext"=>"Calculadora Ley de Ohm"]);
        $canonical = $this->_get_canonical($breadscrumb);

        return view('open.service.electronic.ohmslaw',[
            "result"      => [],
            "seo"         => SeoComponent::get_meta("open.service.electronic.ohmslaw"),
            "canonical"   => $canonical,
            "breadscrumb" => $breadscrumb,
            "submenublog" => $this->_get_submenu_blog(),
            "submenuservice" => $this->_get_submenu_service(),
            "catslug"     => "service"
        ]);
    }
}
