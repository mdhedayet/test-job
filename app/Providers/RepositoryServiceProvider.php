<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Book\EloquentBookRepository;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Reader\EloquentReaderRepository;
use App\Repositories\Reader\ReaderRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(BookRepositoryInterface::class, EloquentBookRepository::class);
        $this->app->bind(ReaderRepositoryInterface::class, EloquentReaderRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
