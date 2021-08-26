<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $commonData = array(
            'lastMessages'=>DB::table('message')->orderBy('id','desc')->limit(5)->get(),
            'unreadMessages'=> DB::table('message')->where('unread',1)->count()
        );
        View::share('commonData', $commonData);
        /*$settings = DB::table('settings')->first();
        config(['app.name' => $settings->site_name]);*/
        Schema::defaultStringLength(191);
    }
}
