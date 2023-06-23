<?php

namespace App\Providers;
use App\Models\Carts;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
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
    public function boot(): void
    {
        view()->composer('header', function ($view) {										
            if (Session('cart')) {										
              $oldCart = Session::get('cart');										
              $cart = new Carts($oldCart);										
              $view->with(['cart' => Session::get('cart'), 										
                          'product_cart' => $cart->items, 										
                          'totalPrice' => $cart->totalPrice, 										
                          'totalQty' => $cart->totalQty										
                          ]);										
                          }										
          });	
    }
}
