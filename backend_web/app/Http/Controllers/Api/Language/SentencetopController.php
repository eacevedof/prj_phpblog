<?php

namespace App\Http\Controllers\Api\Language;

use App\Http\Controllers\BaseController;
use App\Services\Restrict\Language\Sentencetop\SentencetopDeleteService;
use Illuminate\Http\Request;
//use Auth;

use App\Services\Restrict\Language\Sentencetop\SentencetopInsertService;
use App\Services\Restrict\Language\Sentencetop\SentencetopIndexService;
use Illuminate\Support\Facades\DB;

class SentencetopController extends BaseController
{
    public function __construct()
    {
        DB::enableQueryLog();
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index($idsentencetr)
    {
        try {
            $r = (new SentencetopIndexService())->get_by_sentence($idsentencetr);
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
            $r = (new SentencetopInsertService($data))->save();
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
            $r = (new SentencetopDeleteService($idsubject))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    public function bysubject($idsubject)
    {
        try {
            $r = (new SentencetopIndexService())->get_by_subject($idsubject);
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
