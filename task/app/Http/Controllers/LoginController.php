<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\User\IUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        private IUserService $userService
    ){}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        return response()->json($this->userService->authorize($data, 'web'));
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->userService->logout();
        $request->session()->invalidate();

        return redirect('/');
    }
}
