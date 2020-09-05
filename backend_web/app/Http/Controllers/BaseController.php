<?php

namespace App\Http\Controllers;

use App\Component\BreadComponent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as RoutingController;

use App\Traits\Log;
use App\Traits\EnvTrait as Env;

class BaseController extends RoutingController
{
    use Log, Env;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $authid;

    protected function _load_authid(){$this->authid = auth()->id();}

    protected function _get_scrumb($route, $replace=[]){
        return  (new BreadComponent())->get_items("open.home.index")->replace($replace)->get();
    }
}
