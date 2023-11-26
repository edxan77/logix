<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Services\BruteForce\BruteForceProtector;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserService implements IUserService
{
    public function __construct(
        private IUserRepository $userRepository
    ){}

    public function register(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function authorize(array $credentials, string $type): JsonResponse
    {
        $authAttemptKey = Request::ip() . '|' . $credentials['email'];

        if (!BruteForceProtector::check($authAttemptKey)) {
            throw new HttpResponseException(response()->json([
                'status' => 'INVALID_DATA',
                'errors' => [
                    'email' => 'too many attempts try letter',
                    'password' => 'too many attempts try letter'
                ]
            ], 200));
        }

        if (Auth::validate($credentials)) {
            $user = $this->getUserByEmail($credentials['email']);
            $this->userRepository->update($user, ['last_login_at' => now()]);

            if ($type === 'api') {
                return response()->json([
                    'status' => 'OK',
                    'data' => [
                        'jwt' => JWT::encode(['email' => $credentials['email']], config('auth.jwt.key'), 'HS256')
                    ]
                ]);
            }

            Auth::attempt($credentials);

        } else {

            throw new HttpResponseException(response()->json([
                'status' => 'INVALID_DATA',
                'errors' => [
                    'email' => 'invalid credentials',
                    'password' => 'invalid credentials'
                ]
            ], 200));
        }

        return response()->json([
            'status' => 'OK',
            'message' => "successfully authorization"
        ]);
    }

    public function logout(): void {
        Auth::logout();
    }

    public function getUserByEmail(string $username): ?User
    {
        return User::where('email', $username)->first();
    }

    public function getUserByJwtToken(string $token): ?User
    {
       $username =  JWT::decode($token, new Key(config('auth.jwt.key'), 'HS256'))->username;

        return User::where('username', $username)->first();
    }

    public function getUserById(int $id): ?User
    {
        return User::where('id', $id)->first();
    }
}
