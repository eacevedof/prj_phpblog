<?php

namespace App\Http\Controllers\Restrict;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        return view('restrict.admin.index',["module"=>"admin"]);
    }
}
