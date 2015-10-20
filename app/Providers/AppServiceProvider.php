<?php

namespace Twine\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;

use Twine\Repository;
use Twine\Project;
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

        Repository::creating(function ($model) use ($user) {
            $model->created_by = $user->id;
        });

        Project::creating(function ($model) use ($user) {
            $model->created_by = $user->id;
        });

        String::creating(function ($model) use ($user) {
            $model->created_by = $user->id;
        });

        Source::creating(function ($model) use ($user) {
            $model->created_by = $user->id;
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
