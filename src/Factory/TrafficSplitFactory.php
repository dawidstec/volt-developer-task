<?php

namespace VoltDeveloperTask\Factory;

use VoltDeveloperTask\Contract\TrafficSplitInterface;
use VoltDeveloperTask\Handler\EqualLoadTrafficSplit;
use VoltDeveloperTask\Handler\WeightedTrafficSplit;

class TrafficSplitFactory
{
    /** @param array<string, array{"weight":int}> $paymentGateways */
    public function createTrafficSplit(array $paymentGateways): TrafficSplitInterface
    {
        return $this->determineTrafficSplitEnum($paymentGateways);
    }

    /** @param array<string, array{"weight":int}> $paymentGateways */
    private function determineTrafficSplitEnum(array $paymentGateways): TrafficSplitInterface
    {
        $areWeightsEqual = true;
        $firstWeight = null;
        $totalWeight = 0;
        foreach ($paymentGateways as $config) {
            $totalWeight += $config['weight'];

            if ($firstWeight === null) {
                $firstWeight = $config['weight'];
            }

            if ($areWeightsEqual && $firstWeight !== $config['weight']) {
                $areWeightsEqual = false;
            }
        }

        if ($areWeightsEqual && $totalWeight === 100) {
            return $this->createEqualLoadTrafficSplit($paymentGateways);
        }

        return $this->createWeightedTrafficSplit($paymentGateways);
    }

    /** @param array<string, array{"weight":int}> $paymentGateways */
    private function createWeightedTrafficSplit(array $paymentGateways) : TrafficSplitInterface
    {
        return new WeightedTrafficSplit($paymentGateways);
    }

    /** @param array<string, array{"weight":int}> $paymentGateways */
    private function createEqualLoadTrafficSplit(array $paymentGateways): TrafficSplitInterface
    {
        return new EqualLoadTrafficSplit($paymentGateways);
    }


}
