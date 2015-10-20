<?php

namespace Twine\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;

use Twine\Source;
use Twine\String;
use Twine\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $user = Auth::user() ?: User::whereEmail('system@twine')->first();

        String::creating(function ($string) use ($user) {
            $string->created_by = $user->id;
        });

        Source::creating(function ($source) use ($user) {
            $source->created_by = $user->id;
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
