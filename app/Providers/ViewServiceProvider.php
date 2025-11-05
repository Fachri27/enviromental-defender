<?php 
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $route = request()->route();
            $title = $route ? ucwords(str_replace('.', ' › ', $route->getName())) : config('app.name');
            $view->with('title', $title . ' - ' . config('app.name'));
        });
    }
}