<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Services\Common\Apparray\ApparrayService;

class ApparrayController extends BaseController
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function get_source()
    {
        try {
            $r = (new ApparrayService())->get_source();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
