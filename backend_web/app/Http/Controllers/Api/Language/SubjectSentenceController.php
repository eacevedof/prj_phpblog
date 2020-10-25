<?php

namespace App\Http\Controllers\Api\Language;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
//use Auth;

use App\Services\Restrict\Language\Sentence\SentenceDeleteService;
use App\Services\Restrict\Language\Sentence\SentenceInsertService;
use App\Services\Restrict\Language\Sentence\SentenceIndexService;
use App\Services\Restrict\Language\Sentence\SentenceUpdateService;
use App\Services\Restrict\Language\Sentence\SentenceDetailService;
use Illuminate\Support\Facades\DB;

class SubjectSentenceController extends BaseController
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
            $r = (new SentenceIndexService())->get_all();
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
            $r = (new SentenceInsertService($data))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $idsubject
     * @return \Illuminate\Http\Response
     */
    public function show($idsubject)
    {
        try {
            $r = (new SentenceDetailService($idsubject))->get();
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
     * @param  int  $idsubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idsubject)
    {
        $this->logd($idsubject,"update.postid");
        try {
            $data = $request->all();
            $r = (new SentenceUpdateService($data))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $idsubject
     * @return \Illuminate\Http\Response
     */
    public function destroy($idsubject)
    {
        $this->_load_authid();
        $this->logd($idsubject,"delete.postid");
        try {
            $r = (new SentenceDeleteService($idsubject))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
