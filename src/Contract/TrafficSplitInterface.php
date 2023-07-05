<?php

namespace VoltDeveloperTask\Contract;
use VoltDeveloperTask\Model\Payment;

interface TrafficSplitInterface
{
    /** @param PaymentGatewayInterface[] $paymentGateways */
    public function __construct(array $paymentGateways);

    public function handlePayment(Payment $payment): void;

}