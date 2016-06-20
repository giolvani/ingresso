<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('after_equal_format', function($attribute, $value, $parameters)
        {
            if (count($parameters) > 1)
            {
                $format = explode(':', $parameters[1])[1];
                $timestamp = !preg_match('/[-\/]/', $parameters[0]) ? strtotime($parameters[0]) : false;
                $current_value = !preg_match('/[-\/]/', $value) ? strtotime($value) : false;

                if ($timestamp === false)
                {
                    $timestamp = Carbon::createFromFormat($format, Input::get($parameters[0]))->setTime(0, 0, 0)->timestamp;
                }

                if ($current_value === false)
                {
                    $current_value = Carbon::createFromFormat($format, $value)->setTime(0, 0, 0)->timestamp;
                }

                return $timestamp <= $current_value;
            }

            return strtotime(Input::get($parameters[0])) <= strtotime($value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
