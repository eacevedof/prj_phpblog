<?php
namespace App\Http\Controllers;

use App\Component\BreadComponent;
use App\Services\Common\Category\CategoryService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as RoutingController;

use App\Traits\LogTrait as Log;
use App\Traits\EnvTrait as Env;

class BaseController extends RoutingController
{
    use Log, Env;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $authid;

    protected function _load_authid(){$this->authid = auth()->id();}

    protected function _get_canonical(array $breadscrumb=[]): string
    {
        $end = end($breadscrumb);
        $permalink = $end["url"] ?? "";
        if(strlen($permalink)>1 && substr($permalink,-1)==="/")
            $permalink = substr($permalink, 0,-1);
        return $this->get_env("APP_URL").$permalink;
    }

    protected function _get_scrumb($route, $replace=[]): array {
        return  (new BreadComponent())->get_items($route)->replace($replace)->get();
    }

    protected function _get_submenu_blog(){
        return (new CategoryService())->get_submenu_blog();
    }

    protected function _get_submenu_service(){
        return (new CategoryService())->get_submenu_service();
    }

}
