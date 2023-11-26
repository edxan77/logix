<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Services\User\IUserService;

class RegistrationController extends Controller
{
    public function __construct(
        private IUserService $userService
    ){}

    public function register(RegistrationRequest $request)
    {
        $data = $request->validated();
        return $this->userService->register($data);
    }
}
