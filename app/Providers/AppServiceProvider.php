<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('idr', function ($money) {
            return "<?php 
            echo numfmt_format_currency(
                    numfmt_create('id_ID', \NumberFormatter::CURRENCY), 
                    (float) $money, 
                    'IDR') 
            ?>";
        });
    }
}
