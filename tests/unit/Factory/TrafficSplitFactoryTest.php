<?php

namespace unit\Factory;

use PHPUnit\Framework\TestCase;
use VoltDeveloperTask\Factory\TrafficSplitFactory;
use VoltDeveloperTask\Handler\EqualLoadTrafficSplit;
use VoltDeveloperTask\Handler\WeightedTrafficSplit;

class TrafficSplitFactoryTest extends TestCase
{
    public static function trafficSplitDataProvider(): \Generator
    {
        yield 'EqualLoadTrafficSplit 4' => [
            'paymentGateways' => [
                'gateway1' => ['weight' => 25],
                'gateway2' => ['weight' => 25],
                'gateway3' => ['weight' => 25],
                'gateway4' => ['weight' => 25],
            ],
            'expectedClass' => EqualLoadTrafficSplit::class,
        ];
        yield 'EqualLoadTrafficSplit 3' => [
            'paymentGateways' => [
                'gateway1' => ['weight' => 33.333],
                'gateway2' => ['weight' => 33.333],
                'gateway3' => ['weight' => 33.333],
            ],
            'expectedClass' => EqualLoadTrafficSplit::class,
        ];
        yield 'WeightedTrafficSplit 4' => [
            'paymentGateways' => [
                'gateway1' => ['weight' => 40],
                'gateway2' => ['weight' => 30],
                'gateway3' => ['weight' => 20],
                'gateway4' => ['weight' => 10],
            ],
            'expectedClass' => WeightedTrafficSplit::class,
        ];
    }

    public function testBasicCreateTrafficSplit() : void
    {
        $paymentGateways = [
            'gateway1' => ['weight' => 40],
            'gateway2' => ['weight' => 30],
            'gateway3' => ['weight' => 20],
            'gateway4' => ['weight' => 10],
        ];

        $trafficSplitFactory = new TrafficSplitFactory();
        $trafficSplit = $trafficSplitFactory->createTrafficSplit($paymentGateways);

        $this->assertInstanceOf(WeightedTrafficSplit::class, $trafficSplit);
    }

    /** @dataProvider trafficSplitDataProvider */
    public function testCreateTrafficSplit(array $paymentGateways, string $expectedClass) : void
    {
        $trafficSplitFactory = new TrafficSplitFactory();
        $trafficSplit = $trafficSplitFactory->createTrafficSplit($paymentGateways);

        $this->assertInstanceOf($expectedClass, $trafficSplit);
    }
}