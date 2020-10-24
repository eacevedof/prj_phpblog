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

class SubjectController extends BaseController
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->_load_authid();
        try {
            $r = (new SubjectIndexService($this->authid))->get_list_by_user();
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
            $r = (new SubjectInsertService($data, $this->authid))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$this->logd("api.post.show",$id);
        try {
            $r = (new SubjectDetailService($id, $this->authid))->get();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $this->logd($post,"update.postid");
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
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $this->_load_authid();
        $this->logd($post,"delete.postid");
        try {
            $r = (new SubjectDeleteService($post, $this->authid))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
