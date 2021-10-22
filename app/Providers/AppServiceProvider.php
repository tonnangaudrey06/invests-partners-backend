<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

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
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        \Carbon\Carbon::setLocale('fr');

        Blade::directive('numberFormat', function($value){
            return "<?php echo number_format($value, 0, ',', ' ');?> ";
        });

        Blade::directive('dateFormat', function($value){
            return "<?php echo date('d/m/Y', strtotime($value));?> ";
        });

        Blade::directive('timeFormat', function($value){
            return "<?php echo date('H:i', strtotime($value));?> ";
        });
        
    }
}
