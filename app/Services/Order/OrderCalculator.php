<?php

namespace App\Services\Order;

use App\Models\Order;

class OrderCalculator implements OrderCalculatorInterface
{
    public function calculate(Order $order): Order
    {
        // Calculate order details logic
        return $order;
    }
}