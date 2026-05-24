<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    public function adminLogin()
    {
        return view('admin.admin_loginPage');
    }
}
