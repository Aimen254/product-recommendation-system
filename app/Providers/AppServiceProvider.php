<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        \View::composer('frontend.layouts.includes.header', function( $view )
        {
            $data = Project::where('uuid', request()->route('uuid'))->first() ?? null;
            $view->with( 'activeProject', $data );
        });
        \View::composer('frontend.layouts.includes.footer', function( $view )
        {
            $data = Project::where('uuid', request()->route('uuid'))->first() ?? null;
            $view->with( 'activeProject', $data );
        });
        \View::composer('frontend.layouts.app', function( $view )
        {
            $data = Project::where('uuid', request()->route('uuid'))->first() ?? null;
            $view->with( 'activeProject', $data );
        });
    }
}
