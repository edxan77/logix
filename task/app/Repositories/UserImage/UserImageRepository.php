<?php

namespace App\Repositories\UserImage;

use App\Models\UserImage;

class UserImageRepository implements IUserImageRepository
{
    public function create(array $data): UserImage
    {
        $userImage = new UserImage($data);
        $userImage->save();

        return $userImage;
    }
}
