<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailResetRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\ProfileResetRequest;
use App\Models\ProfileReset;
use App\Services\ProfileReset\IProfileResetService;

class ProfileResetController extends Controller
{
    public function __construct(
        private IProfileResetService $profileResetService
    ){}

    public function resetPasswordIndex()
    {
        return view('profile_reset.password.index');
    }

    public function resetPasswordEdit($token)
    {
        $this->profileResetService->getValidProfileResetByToken($token);

        return view('profile_reset.password.reset')->with(['token' => $token]);
    }

    public function passwordResetStore(ProfileResetRequest $request)
    {
       $data = $request->validated();

        return response()->json([
            'status' => 'OK',
            'data' => $this->profileResetService->resetAttempt($data, ProfileReset::RESET_TYPE_PASSWORD)
        ]);
    }

    public function passwordResetUpdate(PasswordResetRequest $request)
    {
        $data = $request->validated();

        return response()->json([
            'status' => 'OK',
            'data' => $this->profileResetService->reset($data, ProfileReset::RESET_TYPE_PASSWORD)
        ]);
    }

    public function successfulReset()
    {
        return view('profile_reset.success');
    }

    public function resetEmailIndex()
    {
        return view('profile_reset.email.index');
    }

    public function resetEmailEdit()
    {
        return view('profile_reset.email.reset');
    }

    public function emailResetStore(ProfileResetRequest $request)
    {
        $data = $request->validated();

        return response()->json([
            'status' => 'OK',
            'data' => $this->profileResetService->resetAttempt($data, ProfileReset::RESET_TYPE_EMAIL)
        ]);
    }

    public function emailResetUpdate(EmailResetRequest $request)
    {
        $data = $request->validated();

        return response()->json([
            'status' => 'OK',
            'data' => $this->profileResetService->reset($data, ProfileReset::RESET_TYPE_EMAIL)
        ]);

    }
}
