#PHP Developer Task

Imagine that as a developer you need to develop a new feature to route transactions between
several payment gateways.

##Requirements:

- You need to write TrafficSplit class(es).
- Each class should have 2 public methods. 
  - Constructor - accepts one argument - list of possible payment gateways with preferred
     weights. 
  - handlePayment(Payment $payment) - will route payment according to the weights passed 
    in construction. 
  
Solution should cover two variants:
  
The first variant will simply put traffic between all of them at equal load (in case of 4 gateways, each should have ~25% load). 
Example test data:

```
[
  Gateway1: {weight: 25}, 
  Gateway2: {weight: 25}, 
  Gateway3: {weight: 25}, 
  Gateway4: {weight: 25}
]
```
The second variant should split the traffic according to weights provided in constructor f.e
```
[
  Gateway1: {weight: 75}, 
  Gateway2: {weight: 10} 
  Gateway3: {weight: 15}
]
```

Algorithm does not need to be 100% accurate, but expected output should be "visible" on 100 or 1000 runs. 

Weight should be passed as percentage. 

You can assume that payment gateway instances has following API: 
- public function getTrafficLoad(): int; 

Please also add readme for your project.


##Sidenotes:
Although the assignment isn’t big, please treat it as if it was the core of a new application. 

Your code will be assessed mainly in terms of maintainability, testability, feel free to test your feature. It will be most appreciated.

Try to challenge yourself and show off your best developer’s skills!

It would be convenient if the assignment was shared as a link to a repository rather than an archive file. 

Feel free to get in touch if you have any questions!

##Good luck!