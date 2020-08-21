<?php

namespace App\Providers;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\ModelRepositories\UserRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TagRepositoryInterface;
use App\Repositories\ModelRepositories\CategoryRepository;
use App\Repositories\ModelRepositories\TagRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected static $repositories = [
        [
            UserRepositoryInterface::class,
            UserRepository::class,
        ],
        [
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        ],
        [
            TagRepositoryInterface::class,
            TagRepository::class,
        ]
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->bind(
                $repository[0],
                $repository[1]
            );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
