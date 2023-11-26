<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\User\IUserService;

class LoginController extends Controller
{
    public function __construct(
        private IUserService $userService
    ){}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        return response()->json($this->userService->authorize($data, 'api'));
    }
}
