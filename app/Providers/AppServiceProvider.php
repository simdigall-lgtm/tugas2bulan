<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (request()->server('HTTP_X_FORWARDED_PROTO') === 'https' || request()->isSecure() || str_contains(request()->url(), 'devtunnels.ms') || str_contains(request()->url(), 'ngrok') || str_contains(request()->url(), 'pinggy') || str_contains(request()->url(), 'localhost.run') || str_contains(request()->url(), 'lhr.life') || str_contains(request()->url(), 'serveo.net')) {
            URL::forceScheme('https');
        }

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $sessionUser = session('user');
            $currentLoggedUser = null;
            if (session()->has('user_id')) {
                $currentLoggedUser = \App\Models\User::find(session('user_id'));
            }
            if (!$currentLoggedUser && $sessionUser) {
                $currentLoggedUser = \App\Models\User::where('name', $sessionUser)->orWhere('email', $sessionUser)->first();
            }

            if ($currentLoggedUser) {
                $displayName = $currentLoggedUser->name;
                $displayEmail = $currentLoggedUser->email;
                $isKasir = (strtolower($displayName) === 'kasir' || str_contains(strtolower($displayEmail), 'kasir'));
                $userRole = $isKasir ? 'Kasir' : 'Administrator';
            } elseif ($sessionUser) {
                $displayName = $sessionUser;
                $isKasir = (strtolower($displayName) === 'kasir');
                $displayEmail = $isKasir ? 'kasir@gmail.com' : 'admin@sipekan.co.id';
                $userRole = $isKasir ? 'Kasir' : 'Administrator';
            } else {
                $displayName = 'Admin SIPEKAN';
                $displayEmail = 'admin@sipekan.co.id';
                $isKasir = false;
                $userRole = 'Administrator';
            }

            $view->with([
                'authUserName' => $displayName,
                'authUserEmail' => $displayEmail,
                'authRole' => $userRole,
                'isKasir' => $isKasir,
            ]);
        });
    }
}
