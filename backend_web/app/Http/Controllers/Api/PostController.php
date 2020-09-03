<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Restrict\Post\PostDeleteService;
use App\Services\Restrict\Post\PostInsertService;
use App\Services\Restrict\Post\PostListService;
use App\Services\Restrict\Post\PostUpdateService;
use App\Services\Restrict\Post\PostDetailService;

class PostController extends BaseController
{
    private $authid;

    public function __construct()
    {
        $this->middleware("auth");
        $this->authid = Auth::id();
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $r = (new PostListService($this->authid))->get_list_by_user();
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
            $r = (new PostInsertService($request, $this->authid))->save();
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
            $r = (new PostDetailService($id, $this->authid))->get();
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
            $r = (new PostUpdateService($request,$this->authid))->save();;
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
        $this->logd($post,"delete.postid");
        $iduser = Auth::id();
        return (new PostDeleteService($post, $iduser))->save();
    }
}

/*
| POST          | api/post                 | post.store           | App\Http\Controllers\Api\PostController@store                          | web        |
| GET|HEAD      | api/post                 | post.index           | App\Http\Controllers\Api\PostController@index                          | web        |
| DELETE        | api/post/{post}          | post.destroy         | App\Http\Controllers\Api\PostController@destroy                        | web
| PATCH         | api/post/{post}          | post.update          | App\Http\Controllers\Api\PostController@update                         | web        |
| GET|HEAD      | api/post/{post}          | post.show            | App\Http\Controllers\Api\PostController@show
*/
