<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function getList()
    {
        return Order::with('branch')->paginate(20);
    }

    public function create(array $data)
    {
        $order = Order::create($data);
        foreach ($data['items'] as $item) {
            $order->items()->create($item);
        }
        return $order;
    }

    public function getDetail(int $id)
    {
        return Order::with('branch')->find($id);
    }

    public function update(array $data, Order $order): Order
    {
        $order->update($data);

        if (isset($data['items'])) {
            $order->items()->delete();
            foreach ($data['items'] as $item) {
                $order->items()->create($item);
            }
        }
        return $order;
    }

    public function delete(Order $order): Order
    {
        $order->delete();

        return $order;
    }
}