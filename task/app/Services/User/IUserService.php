<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface IUserService
{
    public function register(array $data): User;
    public function authorize(array $credentials, string $type): JsonResponse;
    public function logout(): void;
    public function getUserByEmail(string $username): ?User;
    public function getUserById(int $id): ?User;
    public function getUserByJwtToken(string $token): ?User;
}
