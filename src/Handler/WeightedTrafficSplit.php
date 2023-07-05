<?php

namespace VoltDeveloperTask\Handler;

use VoltDeveloperTask\Contract\TrafficSplitInterface;
use VoltDeveloperTask\Model\Payment;

class WeightedTrafficSplit implements TrafficSplitInterface
{
    private array $paymentGateways;

    public function __construct(array $paymentGateways)
    {
        $this->paymentGateways = $paymentGateways;
    }

    /**
     * @throws \Exception
     */
    public function handlePayment(Payment $payment): string
    {
        return $this->getRandomGateway($this->paymentGateways);
    }

    private function getRandomGateway(array $weights): string
    {
        $rand = mt_rand(1, 100);
        foreach ($weights as $gateway => $config) {
            if ($rand <= $config['weight']) {
                return $gateway;
            }
            $rand -= $config['weight'];
        }

        throw new \Exception('No gateway found');
    }
}