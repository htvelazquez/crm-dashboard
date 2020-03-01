<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        view()->composer('*', function($view) {
            $authorizedURI = [];
            if (Auth::check()) {
                $userId = Auth::user()->id;
                $sqlAuthorizedURI = "SELECT roles.uri
                FROM permissions
                INNER JOIN roles
                ON (permissions.role_id = roles.id)
                WHERE user_id = $userId";

                $DBAuthorizedURI = DB::select($sqlAuthorizedURI);

                foreach ($DBAuthorizedURI as $item) {
                    $authorizedURI[] = $item->uri;
                }
            }

            $view->with('authorizedURI', $authorizedURI);
        });
    }
}
