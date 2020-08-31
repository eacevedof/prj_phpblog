<?php

namespace App\Http\Controllers\Restrict;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {}

    public function insert()
    {}

    public function update($idpost)
    {}

    public function delete($idpost)
    {}
}
