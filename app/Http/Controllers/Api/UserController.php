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
        $users = User::paginate(5);
        return UserCollection::collection($users);
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

            if ($input['user_image']) {
                $name = time(). '.' . explode('/', mime_content_type($input['user_image']))[1];
                \Image::make($input['user_image'])->save(public_path('images/profile/').$name);
                $input['user_image'] = $name;
            }

            unset($input['user_type']);
            unset($input['question']);
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
        User::findOrFail($id)->delete();

        // User::withTrashed()
        //     ->where('id', 2)
        //     ->restore();

        return response()->json([
            'status' => 'success',
            'message' => 'User successfully deleted.'
        ], Response::HTTP_OK);

    }

    public function update(UserRequest $request)
    {
        $user = User::find($request->id);
        $input = $request->all();

        if ($input['user_image'] != null) {
            $name = time(). '.' . explode('/', mime_content_type($input['user_image']))[1];
            \Image::make($input['user_image'])->save(public_path('images/profile/').$name);
            $input['user_image'] = $name;
        }

        if (isset($input['password'])) {
            $input['password'] = $this->confirmPassword($input);
        } else {
            $input['password'] = $user->password;
        }

        unset($input['user_type']);
        unset($input['question']);
        unset($input['current_password']);
        unset($input['confirm_password']);

        $user->update($input);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully.',
            'data' => new UserResource($user)
        ], Response::HTTP_OK);
    }

    public function confirmPassword($request)
    {
                // new password ↓
        if (\Hash::check($request['current_password'], auth()->user()->password)) {
            return bcrypt($request['password']);
        }
    }
}
