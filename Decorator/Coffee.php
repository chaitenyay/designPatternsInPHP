<?php

interface iCoffee {
    public function getDescription();
    public function getCost();
}


class Expresso implements iCoffee {
    public $costOfCoffee = 120;
    public function getDescription(){
        return "An Expresson coffee";
    }
    public function getCost(){
        return $this->costOfCoffee;
    }
}

class Mocha implements iCoffee {
    public $costOfCoffee = 150;
    public function getDescription(){
        return "A Mocha coffee";
    }

    public function getCost(){
        return $this->costOfCoffee;
    }    
}

abstract class CoffeDecorator implements iCoffee {

    public $coffee;

    public function __construct(iCoffee $iCoffee){
        $this->coffee = $iCoffee;

    }
    abstract public function getDescription();
    abstract public function getCost();
    
}

class DecorateWithMilk extends CoffeDecorator{

    public $milkCost = 25;

    public function getDescription(){
        return $this->coffee->getDescription() . ", Milk";

    }
    public function getCost(){
        return $this->coffee->getCost() + $this->milkCost;

    }

}

class DecorateWithChocolate extends CoffeDecorator{

    public $milkCost = 45;

    public function getDescription(){
        return $this->coffee->getDescription() . ", Chocolate";

    }
    public function getCost(){
        return $this->coffee->getCost() + $this->milkCost;

    }

}


$ExpressoCoffee = new Expresso();
print_r($ExpressoCoffee->getDescription() . " for cost: " . $ExpressoCoffee->getCost() . "\n");


$ExpressoCoffeeWithMilk = new DecorateWithMilk($ExpressoCoffee);
print_r($ExpressoCoffeeWithMilk->getDescription() . " for cost: " . $ExpressoCoffeeWithMilk->getCost() . "\n");

$ExpressoCoffeeWithMilkAndChocolate = new DecorateWithChocolate($ExpressoCoffeeWithMilk);
print_r($ExpressoCoffeeWithMilkAndChocolate->getDescription() . " for cost: " . $ExpressoCoffeeWithMilkAndChocolate->getCost() ."\n");
