<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Http\Requests\Request\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Model\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $users = User::get();

        return response()->json([
            "success" => "success",
            "message" => "Data found.",
            "data" => UserCollection::collection($users)
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(new UserResource($user));
    }

    public function store(UserRequest $request)
    {
        $message = "User successfully created.";
        $status = "success";
        $code = Response::HTTP_CREATED;

        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $userData = User::create($input);
        } catch(Exception $ex) {
            $message = "User failed to create.";
            $status = "failed";
            $code = Response::HTTP_CONFLICT;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => new UserResource($userData)
        ], $code);
    }

    public function destroy($id)
    {

    }

    public function update(Request $request)
    {

    }
}
