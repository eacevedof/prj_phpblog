<?php
namespace App\Http\Controllers\Common;

use App\Http\Controllers\BaseController;
use App\Services\Common\Email\EmailContactService;

class InfrastructureController extends BaseController
{

    public function get_maxuploadsize()
    {
        try {

            return Response()->json(["data"=>1234],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
