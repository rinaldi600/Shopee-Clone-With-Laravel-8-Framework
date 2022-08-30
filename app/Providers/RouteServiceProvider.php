<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::bind('product', function ($value) {
                try {
                    $decrypt = Crypt::decryptString($value);
                } catch (DecryptException $decryptException) {
                    Log::info('Decrypt Exception for the product id');
                    dd('error');
                }
                return Product::with('seller')->where('id_product', $decrypt)->first();
            });
            Route::bind('order', function ($value) {
                try {
                    $decrypt = Crypt::decryptString($value);
                } catch (DecryptException $decryptException) {
                    Log::info('Decrypt Exception for the order id');
                    dd('error');
                }
                return Order::with(['product','buyer','seller','seller.account'])->where('id_order', $decrypt)->first();
            });

            Route::bind('account', function ($value) {
                try {
                    $decrypt = Crypt::decryptString($value);
                } catch (DecryptException $decryptException) {
                    Log::info('Decrypt Exception for the order id');
                    dd('error');
                }
                return Account::where('id_account', $decrypt)->first();
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
