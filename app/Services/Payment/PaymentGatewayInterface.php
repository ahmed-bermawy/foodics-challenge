<?php

namespace App\Services\Payment;

interface PaymentGatewayInterface
{
    public function processPayment(float $amount): void;
}