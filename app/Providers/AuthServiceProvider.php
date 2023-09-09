<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\CarComments;
use App\Models\CarsComments;
use App\Models\News;
use App\Models\NewsComments;
use App\Models\User;
use App\Policies\CarPolicy;
use App\Policies\NewsPolicy;
use App\Policies\AuthPolicy;
use App\Policies\NewsCommentsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        News::class => NewsPolicy::class,
        NewsComments::class=>NewsCommentsPolicy::class,
        User::class=>AuthPolicy::class,
        CarComments::class=>CarPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('editor', function(User $user) {
            return $user->type === 'editor'|| $user->type ==='admin';
        });
        Gate::define('admin', function(User $user) {
            return $user->type === 'admin';
        });

    }
}
