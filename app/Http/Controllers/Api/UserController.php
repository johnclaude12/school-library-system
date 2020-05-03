<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $users = User::all();

        return response()->json([
            "success" => true,
            "data" => $users
        ]);
    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $message = "User successfully created.";
        $status = "success";
        $code = Response::HTTP_CREATED;

        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            User::create($input);
        } catch(Exception $ex) {
            $message = "User failed to create.";
            $status = "failed";
            $code = Response::HTTP_CONFLICT;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $request->all()
        ], $code);
    }

    public function destroy($id)
    {

    }

    public function update(Request $request)
    {

    }
}
