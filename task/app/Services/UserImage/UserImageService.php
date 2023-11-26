<?php

namespace App\Services\UserImage;

use App\Models\UserImage;
use App\Repositories\UserImage\IUserImageRepository;

class UserImageService implements IUserImageService
{
    public function __construct(
        private IUserImageRepository $userImageRepository
    ){}

    public function save(array $data): UserImage
    {
        return $this->userImageRepository->create($data);
    }
}
