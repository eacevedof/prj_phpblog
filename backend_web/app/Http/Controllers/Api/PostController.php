<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Restrict\Post\PostDeleteService;
use App\Services\Restrict\Post\PostInsertService;
use App\Services\Restrict\Post\PostListService;
use App\Services\Restrict\Post\PostUpdateService;

class PostController extends BaseController
{

    public function __construct()
    {
        //$this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iduser = Auth::id();
        try {
            $r = (new PostListService($iduser))->get_list_by_user();
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
        $iduser = Auth::id();
        $this->logd($request->all(),"request all");
        try {
            $r = (new PostInsertService($request, $iduser))->save();
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
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $iduser = Auth::id();
        return (new PostUpdateService($request,$iduser))->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iduser = Auth::id();
        return (new PostDeleteService($id, $iduser))->save();
    }
}

/*
| POST          | api/post                 | post.store           | App\Http\Controllers\Api\PostController@store                          | web        |
| GET|HEAD      | api/post                 | post.index           | App\Http\Controllers\Api\PostController@index                          | web        |
| DELETE        | api/post/{post}          | post.destroy         | App\Http\Controllers\Api\PostController@destroy                        | web        |
| PUT|PATCH     | api/post/{post}          | post.update          | App\Http\Controllers\Api\PostController@update                         | web        |
| GET|HEAD      | api/post/{post}          | post.show            | App\Http\Controllers\Api\PostController@show
*/
