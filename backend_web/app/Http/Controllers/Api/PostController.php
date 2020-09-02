<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

/*
|        | POST          | api/post                 | post.store           | App\Http\Controllers\Api\PostController@store                          | web        |
|        | GET|HEAD      | api/post                 | post.index           | App\Http\Controllers\Api\PostController@index                          | web        |
|        | DELETE        | api/post/{post}          | post.destroy         | App\Http\Controllers\Api\PostController@destroy                        | web        |
|        | PUT|PATCH     | api/post/{post}          | post.update          | App\Http\Controllers\Api\PostController@update                         | web        |
|        | GET|HEAD      | api/post/{post}          | post.show            | App\Http\Controllers\Api\PostController@show
*/
