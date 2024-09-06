<?php

namespace App\Services\Payment;

class CheckoutPaymentGateway implements PaymentGatewayInterface
{
    public function processPayment(float $amount): void
    {
        // Process the payment
    }
}