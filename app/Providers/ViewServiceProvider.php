<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\View\Composers\HeaderComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.layout.header', HeaderComposer::class);
    }
}
