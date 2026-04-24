<?php

namespace App\Providers;

use App\Services\SeoService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Artikel;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('seo', function () {
            return new SeoService;
        });

        View::composer('*', function ($view) {

            $locale = app()->getLocale();

            $latestAlerta = Artikel::with(['translations' => function ($q) use ($locale) {
                $q->where('locale', $locale);
            }])
                ->where('status', 'publish')
                ->where('type', 'alerta')
                ->latest('created_at') // atau created_at
                ->first();

            $view->with('latestAlerta', $latestAlerta);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
