<?php

namespace App\Http\Controllers;

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


}
