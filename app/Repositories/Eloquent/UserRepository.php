<?php

namespace App\Repositories\Eloquent;

use App\Model\User;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface
{
    CONST CACHE_KEY = 'USERS';

    public function getUsers()
    {
        $cacheKey = Self::CACHE_KEY.".ALL";
        $orderBy = 'created_at';

        return cache()->remember($cacheKey, Carbon::now()->addMinutes(5), function() use ($orderBy) {
            return User::orderBy($orderBy)->get();
        });
    }

    public function getUsersByPaginated($perPage)
    {
        return User::paginate($perPage);
    }

    public function getUser($id)
    {
        $cacheKey = Self::CACHE_KEY.".ID";

        return cache()->remember($cacheKey, Carbon::now()->addMinutes(5), function() use ($id) {
            return User::findOrFail($id);
        });
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
