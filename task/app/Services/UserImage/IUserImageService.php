<?php

namespace App\Services\UserImage;

use App\Models\UserImage;

interface IUserImageService
{
    public function save(array $data) :UserImage;
}
