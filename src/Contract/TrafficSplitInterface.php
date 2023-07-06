<?php

namespace VoltDeveloperTask\Contract;

use VoltDeveloperTask\Model\Payment;

interface TrafficSplitInterface
{
    /** @param array<string, array{"weight":float}> $paymentGateways */
    public function __construct(array $paymentGateways);

    public function handlePayment(Payment $payment): string;

}
