<?php

namespace VoltDeveloperTask\Handler;

use VoltDeveloperTask\Model\Payment;

class EqualLoadTrafficSplit extends WeightedTrafficSplit
{
    public function handlePayment(Payment $payment): string
    {
        $equalLoadWeights = $this->getEqualLoadWeights();
        return $this->getRandomGateway($equalLoadWeights);
    }

    /** @return array<string, array{"weight":float}>  */
    private function getEqualLoadWeights(): array
    {
        $equalLoadWeights = [];
        $gatewayCount = count($this->paymentGateways);
        $equalWeight = floor(100 / $gatewayCount);

        foreach ($this->paymentGateways as $gateway => $config) {
            $equalLoadWeights[$gateway] = ['weight' => $equalWeight];
        }

        return $equalLoadWeights;
    }
}
