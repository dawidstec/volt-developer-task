<?php

namespace VoltDeveloperTask\Handler;

use VoltDeveloperTask\Contract\PaymentGatewayInterface;
use VoltDeveloperTask\Contract\TrafficSplitInterface;
use VoltDeveloperTask\Model\Payment;

class TrafficSplit implements TrafficSplitInterface
{
    /** @param PaymentGatewayInterface[] $paymentGateways */
    public function __construct(array $paymentGateways)
    {
    }

    public function handlePayment(Payment $payment): void
    {
        // TODO: Implement handlePayment() method.
    }
}