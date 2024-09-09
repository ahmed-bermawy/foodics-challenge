<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{

    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderRepository->getList();
        OrderResource::collection($orders);

        return response()->json($orders, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $order = $this->orderRepository->create($data);

        return response()->json(new OrderResource($order), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json(new OrderResource($order), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();
        $order = $this->orderRepository->update($data, $order);

        return response()->json(new OrderResource($order), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->orderRepository->delete($order);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
