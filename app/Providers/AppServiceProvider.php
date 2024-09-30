<?php

namespace App\Providers;

use App\Http\Controllers\SuperAdminController;
use App\Http\Middleware\SuperAdminAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
        Route::middleware([SuperAdminAuth::class])->group(function () {
            Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
        });
    }
}
