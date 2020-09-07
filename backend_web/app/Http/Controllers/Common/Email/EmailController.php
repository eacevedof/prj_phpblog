<?php
namespace App\Http\Controllers\Common\Email;

use App\Http\Controllers\BaseController;
use App\Services\Common\Email\EmailContactService;

class EmailController extends BaseController
{

    public function contact()
    {
        //$this->_load_authid();
        try {
            $data = request()->all();
            //dd($data);
            $r = (new EmailContactService($data))->send();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
