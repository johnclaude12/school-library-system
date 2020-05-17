<?php

namespace App\Repositories;

interface UserRepositoryInterface {

    public function getUsers();

    public function getUsersByPaginated($perPage);

    public function getUser($id);

    public function deleteUser($id);

    public function restoreUser($id);
}
