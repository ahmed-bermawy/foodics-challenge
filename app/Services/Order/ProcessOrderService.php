<?php

namespace App\Services\Order;

use App\Services\InventoryManager;

class ProcessOrderService
{
    public function __construct(private readonly InventoryManager $inventoryManager,)
    {
    }

    public function process($order): void
    {
        $this->storeOrder($order);

        $this->inventoryManager->updateInventory($order);
    }

    /**
     * Stores the order in the database or any other storage mechanism.
     *
     * @param $order
     *
     * @return void
     */
    private function storeOrder($order)
    {
        // Store the order.
    }
}