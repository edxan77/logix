<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserImageRequest;
use App\Services\UserImage\IUserImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserImageController extends Controller
{
    public function __construct(
        private IUserImageService $userImageService
    ){}

    public function index()
    {
        return view('user_image.index');
    }

    public function showImages()
    {
        return view('user_image.gallery');
    }

    public function store(UserImageRequest $request)
    {
        $data['user_id'] = Auth::id();
        $data['image'] = base64_encode(file_get_contents($request->file('image')->path()));

        $this->userImageService->save($data);

        return Redirect::to('/user/images');

    }
}
