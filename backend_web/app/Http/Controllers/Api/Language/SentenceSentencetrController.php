<?php

namespace App\Http\Controllers\Api\Language;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
//use Auth;

use App\Services\Restrict\Language\Sentencetr\SentencetrDeleteService;
use App\Services\Restrict\Language\Sentencetr\SentencetrInsertService;
use App\Services\Restrict\Language\Sentencetr\SentencetrIndexService;
use App\Services\Restrict\Language\Sentencetr\SentencetrUpdateService;
use App\Services\Restrict\Language\Sentencetr\SentencetrDetailService;
use Illuminate\Support\Facades\DB;

class SentenceSentencetrController extends BaseController
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
    public function index($idsentencetr)
    {
        try {
            $r = (new SentencetrIndexService())->get_by_sentence($idsentencetr);
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
            $r = (new SentencetrInsertService($data))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $idsentencetr
     * @return \Illuminate\Http\Response
     */
    public function show($idsentencetr)
    {
        try {
            $r = (new SentencetrDetailService($idsentencetr))->get();
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
     * @param  int  $idsentencetr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idsentencetr)
    {
        $this->logd($idsentencetr,"update.postid");
        try {
            $data = $request->all();
            $r = (new SentencetrUpdateService($data))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $idsentencetr
     * @return \Illuminate\Http\Response
     */
    public function destroy($idsentencetr)
    {
        try {
            $r = (new SentencetrDeleteService($idsentencetr))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}
