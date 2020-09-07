<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Services\Common\Category\CategoryService;

class CategoryController extends BaseController
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $this->_load_authid();
        try {
            $r = (new CategoryService())->get_by_post();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
