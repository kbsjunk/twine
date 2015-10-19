<?php

namespace Twine\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::currentPathResolver(function () {
			dd($this->app['request']->url());
            return $this->app['request']->url();
        });
        Paginator::currentPageResolver(function ($pageName = 'page') {
            return $this->app['request']->input($pageName);
        });
    }
}