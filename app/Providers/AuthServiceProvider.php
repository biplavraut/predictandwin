<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('canAddUser', function ($user) {
            if ($user->type === 'supdev' || $user->type === 'dev' || $user->type === 'supadmin' || $user->type === 'admin') {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('canEditUser', function ($user) {
            if ($user->type === 'supdev' || $user->type === 'dev' || $user->type === 'supadmin' || $user->type === 'admin') {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('canDeleteUser', function ($user) {
            if ($user->type === 'supdev' || $user->type === 'dev' || $user->type === 'supadmin') {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('canView', function ($user) {
            if ($user->type === 'supdev' || $user->type === 'dev' || $user->type === 'supadmin' || $user->type === 'admin' || 'editor') {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('canAdd', function ($user) {
            if ($user->type === 'supdev' || $user->type === 'dev' || $user->type === 'supadmin' || $user->type === 'admin' || 'editor') {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('canEdit', function ($user) {
            if ($user->type === 'supdev' || $user->type === 'dev' || $user->type === 'supadmin' || $user->type === 'admin' || 'editor') {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('canDelete', function ($user) {
            if ($user->type === 'supdev' || $user->type === 'dev' || $user->type === 'supadmin' || $user->type === 'admin') {
                return true;
            } else {
                return false;
            }
        });
        Gate::define('isSupDev', function ($user) {
            return $user->type === 'supdev';
        });
        Gate::define('isDev', function ($user) {
            return $user->type === 'dev';
        });
        Gate::define('isSupAdmin', function ($user) {
            return $user->type === 'supadmin';
        });
        Gate::define('isAdmin', function ($user) {
            return $user->type === 'admin';
        });
        Gate::define('isEditor', function ($user) {
            return $user->type === 'editor';
        });
        Gate::define('isUser', function ($user) {
            return $user->type === 'user';
        });

        //
    }
}
