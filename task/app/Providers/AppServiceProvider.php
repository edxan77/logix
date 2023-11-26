<?php

namespace App\Providers;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\IArticleRepository;
use App\Repositories\Mail\IMailRepository;
use App\Repositories\Mail\MailRepository;
use App\Repositories\ProfileReset\IProfileResetRepository;
use App\Repositories\ProfileReset\ProfileResetRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\UserImage\IUserImageRepository;
use App\Repositories\UserImage\UserImageRepository;
use App\Services\Article\ArticleService;
use App\Services\Article\IArticleService;
use App\Services\BruteForce\BruteForceProtector;
use App\Services\BruteForce\IBruteForceProtector;
use App\Services\Mail\IMailService;
use App\Services\Mail\MailService;
use App\Services\ProfileReset\IProfileResetService;
use App\Services\ProfileReset\ProfileResetService;
use App\Services\User\IUserService;
use App\Services\User\UserService;
use App\Services\UserImage\IUserImageService;
use App\Services\UserImage\UserImageService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IBruteForceProtector::class, BruteForceProtector::class);
        $this->app->bind(IProfileResetService::class, ProfileResetService::class);
        $this->app->bind(IProfileResetRepository::class, ProfileResetRepository::class);
        $this->app->bind(IMailService::class, MailService::class);
        $this->app->bind(IMailRepository::class, MailRepository::class);
        $this->app->bind(IUserImageService::class, UserImageService::class);
        $this->app->bind(IUserImageRepository::class, UserImageRepository::class);
        $this->app->bind(IArticleService::class, ArticleService::class);
        $this->app->bind(IArticleRepository::class, ArticleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
