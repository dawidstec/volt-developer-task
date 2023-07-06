<?php

require_once __DIR__ . '/vendor/autoload.php';

use VoltDeveloperTask\Factory\TrafficSplitFactory;
use VoltDeveloperTask\Model\Payment;

// Creating a sample payment object
$payment = new Payment(1, 100);

$equalLoadGateways = [
    'Gateway1' => ['weight' => 25],
    'Gateway2' => ['weight' => 25],
    'Gateway3' => ['weight' => 25],
    'Gateway4' => ['weight' => 25]
];
$factory = new TrafficSplitFactory();

$equalLoadSplit = $factory->createTrafficSplit($equalLoadGateways);
echo $equalLoadSplit->handlePayment($payment) . PHP_EOL;



$weightedGateways = [
    'Gateway1' => ['weight' => 75],
    'Gateway2' => ['weight' => 10],
    'Gateway3' => ['weight' => 15]
];

$weightedSplit = $factory->createTrafficSplit($weightedGateways);
echo $weightedSplit->handlePayment($payment) . PHP_EOL;
