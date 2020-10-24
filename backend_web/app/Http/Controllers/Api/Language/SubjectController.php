<?php

namespace App\Http\Controllers\Api\Language;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
//use Auth;

use App\Services\Restrict\Language\Subject\SubjectDeleteService;
use App\Services\Restrict\Language\Subject\SubjectInsertService;
use App\Services\Restrict\Language\Subject\SubjectIndexService;
use App\Services\Restrict\Language\Subject\SubjectUpdateService;
use App\Services\Restrict\Language\Subject\SubjectDetailService;
use Illuminate\Support\Facades\DB;

class SubjectController extends BaseController
{
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $r = (new SubjectIndexService())->get_all();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $r = (new SubjectInsertService($data))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $subjid
     * @return \Illuminate\Http\Response
     */
    public function show($subjid)
    {
        try {
            $r = (new SubjectDetailService($subjid))->get();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $subjid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subjid)
    {
        $this->logd($subjid,"update.postid");
        try {
            $data = $request->all();
            $r = (new SubjectUpdateService($data))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $subjid
     * @return \Illuminate\Http\Response
     */
    public function destroy($subjid)
    {
        $this->_load_authid();
        $this->logd($subjid,"delete.postid");
        try {
            $r = (new SubjectDeleteService($subjid))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
