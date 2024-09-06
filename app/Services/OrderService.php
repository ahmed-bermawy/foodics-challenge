<?php

namespace App\Services;

use App\Exceptions\ValidationException;
use App\Models\Order;
use App\Services\Notification\CustomerNotifierInterface;
use App\Services\Order\OrderCalculatorInterface;
use App\Services\Order\ProcessOrderService;
use App\Services\Payment\PaymentGatewayInterface;

class OrderService
{
    /**
     * The OrderService constructor.
     *
     * @param $checkoutPaymentGateway
     * @param $inventoryManager
     */
    public function __construct(
        private readonly PaymentGatewayInterface $checkoutPaymentGateway,
        private readonly OrderCalculatorInterface $orderCalculator,
        private readonly CustomerNotifierInterface $customerNotifier,
        private readonly ProcessOrderService $processOrderService,
        private readonly InvoiceService $invoiceService
        )
    {
    }

    /**
     * Validates the order, calculates order details, processes the order and payment,
     * notifies the customer, and sends an invoice.
     *
     * @param Order $order
     *
     * @return void
     * @throws ValidationException
     */
    public function placeOrder(Order $order): void
    {
        $validateOrder = $this->validateOrder($order);
        if (!$validateOrder) {
            throw new ValidationException('Order validation failed.');
        }

        $order = $this->orderCalculator->calculate($order);

        $this->processOrderService->process($order);
        $this->checkoutPaymentGateway->processPayment($order->getTotalAmount());

        $this->customerNotifier->notify($order);
        $this->invoiceService->send($order);
    }

    /**
     * Validates the order data.
     *
     * @param $order
     *
     * @return bool
     * @thows ValidationException
     */
    private function validateOrder($order): bool
    {
        // Validate the order data.

        return true;
    }

}
