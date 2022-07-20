<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;


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
        View::share('currentUser', Auth::user());
        
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

        Blade::directive('numberFormat', function ($value) {
            return "<?php echo number_format($value, 0, ',', ' ');?>";
        });

        Blade::directive('moneyFormat', function ($value) {
            return "<?php
                if ($value > 999999) {
                    echo number_format($value/1000000, 0, ',', ' ') . 'M';
                } else {
                    echo number_format($value, 0, ',', ' ');
                }
            ?>";
        });

        Blade::directive('dateFormat', function ($value) {
            return "<?php echo date('d/m/Y', strtotime($value));?>";
        });

        Blade::directive('dateFormat2', function ($value) {
            return "<?php echo date('d-m-Y', strtotime($value));?>";
        });

        Blade::directive('timeFormat', function ($value) {
            return "<?php echo date('H:i', strtotime($value));?>";
        });
        
        // Collection::macro('bySource', function ($status) {
        //     return $this->filter(function ($value) use ($status) {
        //         return $value->status == $status;
        //     });
        // });
    }
}
