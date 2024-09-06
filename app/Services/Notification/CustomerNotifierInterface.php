<?php

namespace App\Services\Notification;

use App\Models\Order;

interface CustomerNotifierInterface
{
    public function notify(Order $order): void;
}