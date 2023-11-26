<?php

namespace App\Repositories\UserImage;

use App\Models\UserImage;

interface IUserImageRepository
{
    public function create(array $data): UserImage;
}
