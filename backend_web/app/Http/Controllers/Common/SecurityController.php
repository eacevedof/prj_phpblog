<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;

class SecurityController extends Controller
{
    /**
     * @return View
     */
    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}
