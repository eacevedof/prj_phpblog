<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
//use Auth;

use App\Services\Restrict\Post\PostDeleteService;
use App\Services\Restrict\Post\PostInsertService;
use App\Services\Restrict\Post\PostIndexService;
use App\Services\Restrict\Post\PostUpdateService;
use App\Services\Restrict\Post\PostDetailService;

class PostController extends BaseController
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
            $r = (new PostIndexService($this->authid))->get_list_by_user();
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
            $r = (new PostInsertService($data, $this->authid))->save();
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
            $data = $request->all();
            $r = (new PostUpdateService($data))->save();
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
            $r = (new PostDeleteService($post, $this->authid))->save();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }
    }
}

/*
| POST          | api/post                 | post.store           | App\Http\Controllers\Api\PostController@store                          | web        |
| GET|HEAD      | api/post                 | post.index           | App\Http\Controllers\Api\PostController@index                          | web        |
| DELETE        | api/post/{post}          | post.destroy         | App\Http\Controllers\Api\PostController@destroy                        | web
| PATCH         | api/post/{post}          | post.update          | App\Http\Controllers\Api\PostController@update                         | web        |
| GET|HEAD      | api/post/{post}          | post.show            | App\Http\Controllers\Api\PostController@show
*/
