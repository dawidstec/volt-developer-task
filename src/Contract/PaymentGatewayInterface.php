<?php

namespace VoltDeveloperTask\Contract;

interface PaymentGatewayInterface
{
    public function getTrafficLoad(): int;
}