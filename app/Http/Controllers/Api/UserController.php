<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function register(Request $request)
    {
        dd(auth()->user());
    }

    public function get_user()
    {
        $users = User::all();

        return response()->json([
            "success" => true,
            "data" => $users
        ]);
    }
}
