<?php

namespace App\Providers;

use App\City;
use App\State;
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
        View::composer(['web.include.footer'], function($view){
            $footer_data =null;
            $state = State::where('status',1)->orderBy('name','asc')->get();
            $city = City::where('status',1)->orderBy('name','asc')->get();
            $footer_data =['state'=>$state,'city'=>$city];
            $view->with('footer_data',$footer_data);
         });
    }
}
