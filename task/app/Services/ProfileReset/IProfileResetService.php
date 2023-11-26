<?php

namespace App\Services\ProfileReset;

use App\Models\ProfileReset;

interface IProfileResetService
{
    public function resetAttempt(array $data, string $type): ProfileReset;
    public function reset(array $data, string $type): ProfileReset;
    public function getValidProfileResetByCode(string $code): ?ProfileReset;
    public function getValidProfileResetByToken(string $token): ?ProfileReset;
}
