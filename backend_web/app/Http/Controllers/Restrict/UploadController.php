<?php

namespace App\Http\Controllers\Restrict;

use App\Http\Controllers\BaseController;
use App\Services\Common\UploadService;
use Illuminate\Http\Request;

class UploadController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        //post: resource-usertoken
        $token = (new UploadService())->get_token();
        return view('restrict.upload.index',["module"=>"upload","token"=>$token]);
    }

    public function insert()
    {
        //post: resource-usertoken
        $token = (new UploadService())->get_token();
        return view('restrict.upload.insert',["module"=>"upload","token"=>$token]);
    }

}
