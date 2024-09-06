<?php

namespace App\Services\Order;

use App\Models\Order;

interface OrderCalculatorInterface
{
    public function calculate(Order $order): Order;
}