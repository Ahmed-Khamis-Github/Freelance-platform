<?php

namespace App\Providers;

use App\Models\Config as ModelsConfig;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\Paginator;
use NumberFormatter;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


        $this->app->singleton('currency', function () {
            return new NumberFormatter(App::currentLocale(), NumberFormatter::CURRENCY);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (ModelsConfig::all() as $config) {
            Config::set($config->name, $config->value);
        }

        if (Config::get('app.env') == 'production') {
            Config::set('app.debug', false);
        }

        Paginator::useBootstrap();
    }
}
