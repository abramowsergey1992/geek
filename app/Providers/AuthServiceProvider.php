<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('is-auth', function () {
            return Auth::check();
        });
        Gate::define('is-admin', function () {
            if (Auth::check()) {
                $user = User::where('id', Auth::user()->id)->first();
                return $user->role == "administrator";
            } else {
                return false;
            }
        });

        Gate::define('post-crud', function ($usr, $user_id) {

            if (Auth::check()) {
                $user = User::where('id', Auth::user()->id)->first();
                return Auth::user()->id == $user_id || $user->role == "administrator";
            } else {
                return false;
            }
        });
        Gate::define('user-crud', function ($usr, $user_id) {

            if (Auth::check()) {

                $user = User::where('id', Auth::user()->id)->first();
                return $user->id == $user_id || $user->role == "administrator";
            } else {
                return false;
            }
        });
    }
}
