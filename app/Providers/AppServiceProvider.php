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

        // Auto-provision printing columns if not yet present in database
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('pesanans')) {
                if (!\Illuminate\Support\Facades\Schema::hasColumn('pesanans', 'detail_items')) {
                    \Illuminate\Support\Facades\Schema::table('pesanans', function (\Illuminate\Database\Schema\Blueprint $table) {
                        $table->longText('detail_items')->nullable();
                        $table->text('catatan_finishing')->nullable();
                        $table->string('file_desain')->nullable();
                        $table->string('status_pembayaran')->default('Belum Lunas');
                        $table->bigInteger('sisa_bayar')->default(0);
                    });
                }
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('pembayarans')) {
                if (!\Illuminate\Support\Facades\Schema::hasColumn('pembayarans', 'uang_diterima')) {
                    \Illuminate\Support\Facades\Schema::table('pembayarans', function (\Illuminate\Database\Schema\Blueprint $table) {
                        $table->bigInteger('uang_diterima')->nullable();
                        $table->bigInteger('kembalian')->nullable();
                    });
                }
            }
        } catch (\Throwable $e) {
            // Ignore schema check errors gracefully
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

            // Load company settings
            $settingsPath = storage_path('app/settings.json');
            $defaultSettings = [
                'company_name' => 'SIPEKAN (CV Prima Grafika)',
                'company_address' => 'Jl. Percetakan Negara No. 45, Komplek Ruko Sentra Niaga Blok B2, Jakarta Pusat, DKI Jakarta 10560',
                'company_phone' => '+62 21 555 0192',
                'company_email' => 'info@sipekan.co.id',
                'company_npwp' => '01.234.567.8-012.000',
                'company_website' => 'https://sipekan.co.id',
                'currency' => 'IDR',
                'date_format' => 'DD/MM/YYYY',
                'timezone' => 'Asia/Jakarta',
            ];
            $companySettings = $defaultSettings;
            if (file_exists($settingsPath)) {
                $loaded = json_decode(@file_get_contents($settingsPath), true);
                if (is_array($loaded)) {
                    $companySettings = array_merge($defaultSettings, $loaded);
                }
            }

            $view->with([
                'authUserName' => $displayName,
                'authUserEmail' => $displayEmail,
                'authRole' => $userRole,
                'isKasir' => $isKasir,
                'companySettings' => $companySettings,
            ]);
        });
    }
}
