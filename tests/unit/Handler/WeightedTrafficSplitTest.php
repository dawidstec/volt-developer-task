<?php

namespace unit\Handler;

use PHPUnit\Framework\TestCase;
use VoltDeveloperTask\Model\Payment;
use VoltDeveloperTask\Handler\WeightedTrafficSplit;

class WeightedTrafficSplitTest extends TestCase
{
    public function testBasicHandlePayment() : void
    {
        $paymentGateways = [
            'gateway1' => ['weight' => 40],
            'gateway2' => ['weight' => 30],
            'gateway3' => ['weight' => 20],
            'gateway4' => ['weight' => 10],
        ];

        $trafficSplit = new WeightedTrafficSplit($paymentGateways);
        $payment = new Payment(123, 20);

        $result = $trafficSplit->handlePayment($payment);
        $this->assertStringContainsString('gateway', $result);
    }

    /** @dataProvider trafficDistributionDataProvider */
    public function testTrafficDistribution(int $runs, float $delta, array $paymentGateways) : void
    {
        $trafficSplit = new WeightedTrafficSplit($paymentGateways);
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
            // 25% delta because: Algorithm does not need to be 100% accurate, but expected output should be "visible" on 100 or 1000 runs.
            'delta' => 25,
            'paymentGateways' => [
                'gateway1' => ['weight' => 40],
                'gateway2' => ['weight' => 30],
                'gateway3' => ['weight' => 20],
                'gateway4' => ['weight' => 10],
            ],
        ];

        yield '1000 runs' => [
            'runs' => 1000,
            // 10% delta because: Algorithm does not need to be 100% accurate, but expected output should be "visible" on 100 or 1000 runs.
            'delta' => 10,
            'paymentGateways' => [
                'gateway1' => ['weight' => 40],
                'gateway2' => ['weight' => 30],
                'gateway3' => ['weight' => 20],
                'gateway4' => ['weight' => 10],
            ],
        ];

        yield '10000 runs' => [
            'runs' => 10000,
            // 5% delta because: Algorithm does not need to be 100% accurate, but expected output should be "visible" on 100 or 1000 runs.
            'delta' => 5,
            'paymentGateways' => [
                'gateway1' => ['weight' => 40],
                'gateway2' => ['weight' => 30],
                'gateway3' => ['weight' => 20],
                'gateway4' => ['weight' => 10],
            ],
        ];

        yield '100000 runs' => [
            'runs' => 100000,
            // 5% delta because: Algorithm does not need to be 100% accurate, but expected output should be "visible" on 100 or 1000 runs.
            'delta' => 5,
            'paymentGateways' => [
                'gateway1' => ['weight' => 40],
                'gateway2' => ['weight' => 30],
                'gateway3' => ['weight' => 20],
                'gateway4' => ['weight' => 10],
            ],
        ];
    }
}

