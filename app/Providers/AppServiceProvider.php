<?php

namespace App\Providers;

use View;
use App\Models\User;
use App\Models\Setting;
use App\Models\Constant;
use App\Models\Notification;
use App\Observers\UserObserver;
use App\Console\Commands\ModelMakeCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;


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
        date_default_timezone_set("Asia/Karachi");

        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match("/^[\pL\s]+$/u", $value); 
        });
        
        // Command for models
        Schema::defaultStringLength(191);
        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });

        // Loading settings from database into configuration
        if (Schema::hasTable('settings')) {
            config([
                'global' => Setting::all([
                    'name', 'value'
                ])
                ->keyBy('name') // key every setting by its name
                ->transform(function ($setting) {
                     return $setting->value; // return only the value
                })
                ->toArray() // make it an array
            ]);
        }

        //
        config([
            'global.DATE_FORMAT' => Constant::DATE_FORMAT
        ]);

        // // Registerign user CRUD observer
        User::observe(UserObserver::class);
        
        // View Notifications on Admin Web
        // View::share('notifications', Notification::where('user_id' , 1 )->latest()->limit(8)->get());
    }
}
