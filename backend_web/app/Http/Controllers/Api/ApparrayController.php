<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Services\Common\Apparray\ApparrayService;

class ApparrayController extends BaseController
{
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

    public function get_langcontext()
    {
        try {
            $r = (new ApparrayService())->get_langcontext();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    public function get_langtype()
    {
        try {
            $r = (new ApparrayService())->get_langtype();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    public function get_sslmethods()
    {
        try {
            $r = (new ApparrayService())->get_sslmethods();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
