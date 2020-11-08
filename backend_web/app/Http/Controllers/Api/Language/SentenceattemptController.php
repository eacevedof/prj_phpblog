<?php

namespace App\Http\Controllers\Api\Language;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
//use Auth;

use App\Services\Restrict\Language\Sentencetr\SentencetrInsertService;
use App\Services\Restrict\Language\Sentencetr\SentencetrIndexService;
use Illuminate\Support\Facades\DB;

class SentenceattemptController extends BaseController
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
}
