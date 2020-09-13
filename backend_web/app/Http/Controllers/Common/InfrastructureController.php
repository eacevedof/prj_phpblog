<?php
namespace App\Http\Controllers\Common;

use App\Http\Controllers\BaseController;
use App\Services\Common\Infrastructure\InfrastructureService;

class InfrastructureController extends BaseController
{
    public function get_maxuploadsize()
    {
        try {
            $r = InfrastructureService::get_maxsize_bytes();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
