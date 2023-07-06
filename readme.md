#Readme
## Envirement
To correctly setup environment you need to run folowing commands:
```
make install
make start
make composer-install
```
## Description

In this project I have implemented one interface and two classes.
Interface is called `TrafficSplitInterface` and it has two methods:
- `__construct(array $gateways)` it takes array of gateways as argument
- `handlePayment(Payment $payment)` it takes payment as argument and returns gateway
Those two classes are implementing this interface:
- `EqualLoadTrafficSplit` it splits traffic between all gateways at equal load
- `WeightedTrafficSplit` it splits traffic according to weights provided in constructor
I also created `Payment` class which is used in `handlePayment` method.
In the project I also used factory pattern to create gateways.
In case of running above classes you can see that it is not 100% accurate, but expected output is "visible" on 100 or 1000 runs.

## Tests
To run tests you need to run: 
```
make test
``` 
command.
I created 2 tests for `EqualLoadTrafficSplit` class and 2 tests for `WeightedTrafficSplit` class.
I also created 2 tests for `TrafficSplitFactory` class.

## Example
Tests are checking if `handlePayment` method returns correct gateway.
To run program you need to run following commands: 
```
make exec
php example.php
```

If any refactor is needed, don't hesitate to contact me.



Dawid Stec 2023 for Volt.io