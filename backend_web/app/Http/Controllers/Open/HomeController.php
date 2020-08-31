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
        $this->log("hola mundo");
        return view('open.home.index', []);
    }
}
