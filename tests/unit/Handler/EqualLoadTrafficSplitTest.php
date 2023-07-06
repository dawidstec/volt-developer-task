<?php

namespace unit\Handler;

use PHPUnit\Framework\TestCase;
use VoltDeveloperTask\Handler\EqualLoadTrafficSplit;
use VoltDeveloperTask\Model\Payment;

class EqualLoadTrafficSplitTest extends TestCase
{

    public function testBasicHandlePayment() : void
    {
        $paymentGateways = [
            'gateway1' => ['weight' => 40],
            'gateway2' => ['weight' => 30],
            'gateway3' => ['weight' => 20],
            'gateway4' => ['weight' => 10],
        ];

        $trafficSplit = new EqualLoadTrafficSplit($paymentGateways);
        $payment = new Payment(123, 20);

        $result = $trafficSplit->handlePayment($payment);
        $this->assertStringContainsString('gateway', $result);
    }

    /** @dataProvider trafficDistributionDataProvider */
    public function testTrafficDistribution(int $runs, float $delta, array $paymentGateways) : void
    {
        $trafficSplit = new EqualLoadTrafficSplit($paymentGateways);
        $payment = new Payment(123, 20);

        $gatewayCounts = [];

        for ($i = 0; $i < $runs; $i++) {
            $returnedGateway = $trafficSplit->handlePayment($payment);
            $gatewayCounts[$returnedGateway] = ($gatewayCounts[$returnedGateway] ?? 0) + 1;
        }

        foreach ($paymentGateways as $gateway => $config) {
            $this->assertEqualsWithDelta($config['weight'], $gatewayCounts[$gateway] / $runs * 100, $delta);
        }
    }


    public static function trafficDistributionDataProvider() : \Generator
    {
        yield '100 runs' => [
            'runs' => 100,
            'delta' => 25,
            'paymentGateways' => [
                'gateway1' => ['weight' => 25],
                'gateway2' => ['weight' => 25],
                'gateway3' => ['weight' => 25],
                'gateway4' => ['weight' => 25],
            ],
        ];

        yield '1000 runs' => [
            'runs' => 1000,
            'delta' => 10,
            'paymentGateways' => [
                'gateway1' => ['weight' => 25],
                'gateway2' => ['weight' => 25],
                'gateway3' => ['weight' => 25],
                'gateway4' => ['weight' => 25],
            ],
        ];
    }
}