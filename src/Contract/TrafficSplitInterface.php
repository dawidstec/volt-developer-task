<?php

namespace VoltDeveloperTask\Contract;
use VoltDeveloperTask\Model\Payment;

/**
 * Each class should have 2 public methods.
* 1. Constructor - accepts one argument - list of possible payment gateways with preferred
* weights.
* 2. handlePayment(Payment $payment) - will route payment according to the weights passed
* in construction
 */
interface TrafficSplitInterface
{
    /** @param PaymentGatewayInterface[] $paymentGateways */
    public function __construct(array $paymentGateways);

    public function handlePayment(Payment $payment): void;

}