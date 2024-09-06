<?php

namespace App\Services\Notification;

use App\Models\Order;

class CustomerNotifier implements CustomerNotifierInterface
{

    public function notify(Order $order): void
    {
        // Notify the customer about the order.
    }
}