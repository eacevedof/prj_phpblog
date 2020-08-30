<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function __invoke()
    {
        return view('open.home', []);
    }
}
