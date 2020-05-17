<?php

namespace App\Repositories\Eloquent;

use App\Model\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getUsers()
    {
        return User::all();
    }

    public function getUsersByPaginated($perPage)
    {
        return User::paginate($perPage);
    }

    public function getUser($id)
    {
        return User::findOrFail($id);
    }

    public function deleteUser($id)
    {
        return User::findOrFail($id)->delete();
    }

    public function restoreUser($id)
    {
        return User::withTrashed()->where('id', $id)->restore();
    }
}
