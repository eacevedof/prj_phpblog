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
        $serv = new UploadService();

        return view('restrict.upload.index',[
            "module"        => "upload",
            "token"         => $serv->get_token(),
            "uploaddomain"  => $serv->get_rootendpoint(),
        ]);
    }

    public function insert()
    {
        //post: resource-usertoken
        $serv = new UploadService();

        return view('restrict.upload.index',[
            "module"        => "upload",
            "token"         => $serv->get_token(),
            "uploaddomain"  => $serv->get_rootendpoint(),
        ]);
    }

}
