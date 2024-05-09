<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return view('content.admin.users.manage');
    }
}
