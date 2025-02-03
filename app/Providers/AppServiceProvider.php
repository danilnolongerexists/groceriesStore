<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\PhoneRule;


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
    public function boot()
    {
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            $countryCode = $parameters[0] ?? 'ru';
            $rule = new PhoneRule($countryCode);
            return $rule->passes($attribute, $value);
        });
    }
}
