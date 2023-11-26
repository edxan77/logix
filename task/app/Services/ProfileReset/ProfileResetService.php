<?php

namespace App\Services\ProfileReset;

use App\Models\ProfileReset;
use App\Repositories\ProfileReset\IProfileResetRepository;
use App\Repositories\User\IUserRepository;
use App\Services\Mail\IMailService;
use App\Services\User\IUserService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileResetService implements IProfileResetService
{
    public function __construct(
        private IProfileResetRepository $profileResetRepository,
        private IUserService $userService,
        private IUserRepository $userRepository,
        private IMailService $mailService,
    ){}

    public function resetAttempt(array $data, string $type): ProfileReset
    {
        $resetUser = $this->userService->getUserByEmail($data['email']);
        if (!$resetUser) {
            throw new HttpResponseException(response()->json([
                'status' => 'INVALID_DATA',
                'errors' => [
                    'email' => 'Email not found',
                ]
            ], 200));
        }

        if ($type === ProfileReset::RESET_TYPE_PASSWORD) {
            $data['token'] = $this->generateToken();
        } else {
            $data['code'] = $this->generateCode();
        }

        $data['type'] = $type;
        $data['user_id'] = $resetUser->id;
        $data['status'] = ProfileReset::TOKEN_STATUS_VALID;

        DB::transaction(function () use (&$profileReset, $resetUser, $data) {
            $this->invalidatePreviousResetAttempts($resetUser->email);
            $profileReset = $this->profileResetRepository->create($data);
            $this->mailService->send($data, $profileReset);
        });

        return $profileReset;
    }

    public function reset(array $data, string $type): ProfileReset
    {
        if ($type === ProfileReset::RESET_TYPE_EMAIL) {
            $profileReset = $this->getValidProfileResetByCode($data['code']);

            if (!$profileReset) {
                throw new HttpResponseException(response()->json([
                    'status' => 'INVALID_DATA',
                    'errors' => [
                        'code' => 'invalid Code',
                    ]
                ], 200));
            }

            $resetUser = $this->userService->getUserById($profileReset->user_id);

            DB::transaction(function () use ($profileReset, $resetUser, $data) {
                $this->profileResetRepository->update($profileReset, ['status' => ProfileReset::TOKEN_STATUS_EXPIRED]);
                $this->userRepository->update($resetUser,['email' => $data['email']]);
            });

            return $profileReset;
        } else {
            $profileReset = $this->getValidProfileResetByToken($data['token']);
            $resetUser = $this->userService->getUserById($profileReset->user_id);

            DB::transaction(function () use ($profileReset, $resetUser, $data) {
                $this->profileResetRepository->update($profileReset, ['status' => ProfileReset::TOKEN_STATUS_EXPIRED]);
                $this->userRepository->update($resetUser,['password' => $data['password']]);
            });

            return $profileReset;
        }
    }

    private function generateToken(): string
    {
        $token = Str::random(40);

        if (empty(ProfileReset::where('token', $token)->first())) {
            return $token;
        }

        return $this->generateToken();
    }

    private function generateCode(): string
    {
        $code = '';

        while (strlen($code) < 4) {
            $code .= rand(0, 9);
        }

        if (empty(ProfileReset::where('code', $code)->first())) {
            return $code;
        }

        return $this->generateCode();
    }

    public function getValidProfileResetByCode(string $code): ?ProfileReset
    {
        return ProfileReset::where('code', $code)->where('created_at', '>=', now()->subMinutes(30))->where('status', ProfileReset::TOKEN_STATUS_VALID)->orderBy('id', 'desc')->first();
    }

    public function getValidProfileResetByToken(string $token): ?ProfileReset
    {
        return ProfileReset::where('token', $token)->where('created_at', '>=', now()->subMinutes(30))->where('status', ProfileReset::TOKEN_STATUS_VALID)->orderBy('id', 'desc')->firstOrFail();
    }

    private function invalidatePreviousResetAttempts(string $email): void
    {
        $validProfileResets =  ProfileReset::where('email', $email)->where('status', ProfileReset::TOKEN_STATUS_VALID);
        $this->profileResetRepository->update($validProfileResets, ['status' => ProfileReset::TOKEN_STATUS_EXPIRED]);
    }
}
