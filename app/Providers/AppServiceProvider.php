<?php

namespace App\Providers;

use App\Models\brand_product;
use App\Models\category_product;
use App\Models\post;
use App\Models\product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
    {   Paginator::useBootstrap();
        view()->composer('*',function($view){
        $count_product = product::all()->count();
        $count_post= post::all()->count();
        $count_brand = brand_product::all()->count();
        $count_cate_product = category_product::all()->count();
        $max = product::max('product_price') + 100000;
        $min = product::min('product_price') - 10000;
        $view->with('count_product', $count_product)->with('count_post', $count_post)->with('count_brand', $count_brand)
        ->with('count_cate_product', $count_cate_product)->with('max', $max)->with('min', $min);
        });



    }
}
