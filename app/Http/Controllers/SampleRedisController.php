<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;

class SampleRedisController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        $users = $this->userRepository->getUsers();
        $total = $users->count();

        return view('redis.redis', compact('users', 'total'));
    }
}
