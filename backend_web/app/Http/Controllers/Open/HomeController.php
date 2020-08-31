<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    /**
     * @return View
     */
    public function __invoke()
    {
        return view('open.home.index', []);
    }
}
