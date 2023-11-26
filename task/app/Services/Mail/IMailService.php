<?php

namespace App\Services\Mail;

use App\Models\ProfileReset;

interface IMailService
{
    public function send(array $data, ProfileReset $profileReset);
}
