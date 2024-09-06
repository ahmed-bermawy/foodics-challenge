<?php

namespace App\Providers;

use App\Services\Notification\CustomerNotifier;
use App\Services\Notification\CustomerNotifierInterface;
use App\Services\Order\OrderCalculator;
use App\Services\Order\OrderCalculatorInterface;
use App\Services\Payment\CheckoutPaymentGateway;
use App\Services\Payment\PaymentGatewayInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayInterface::class, CheckoutPaymentGateway::class);
        $this->app->bind(OrderCalculatorInterface::class, OrderCalculator::class);
        $this->app->bind(CustomerNotifierInterface::class, CustomerNotifier::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
