<?php

/*
In this example we used factory class instead of factory method.

*/

// 1. Create Product interface
interface Pizza {
    public function prepare();
    public function bake();
    public function cut();
    public function box();
}

//2. Create the concreate product classess
class NYCheesePizza implements Pizza {
    
    public $pizzaName = "Cheese Pizza";
    
    public function prepare(){
        print_r("Prepare " . $this->pizzaName . " using suitable ingredients.\n");
    }
    
    public function bake(){
        print_r("Bake pizza at 350 degrees.\n");
    }
    
    public function cut(){
        print_r("Cut the pizza in triangular shape.\n");
    }
    
    public function box(){
        print_r("Box the pizza properly.\n");
        print_r("" . $this->pizzaName . " is ready for delivery.\n");
    }
}

class INDCheesePizza implements Pizza {
    
    public $pizzaName = "Cheese Pizza";
    
    public function prepare(){
        print_r("Prepare " . $this->pizzaName . " using suitable ingredients.\n");
    }
    
    public function bake(){
        print_r("Bake pizza at 450 degrees.\n");
    }
    
    public function cut(){
        print_r("Cut the pizza in triangular shape.\n");
    }
    
    public function box(){
        print_r("Box the pizza properly.\n");
        print_r("" . $this->pizzaName . " is ready for delivery.\n");
    }
}

class NYFarmhousePizza implements Pizza {
    
    public $pizzaName = "Farmhouse Pizza";
    
    public function prepare(){
        print_r("Prepare " . $this->pizzaName . " using suitable ingredients.\n");
    }
    
    public function bake(){
        print_r("Bake pizza at 500 degrees.\n");
    }
    
    public function cut(){
        print_r("Cut the pizza in square shape.\n");
    }
    
    public function box(){
        print_r("Box the pizza properly.\n");
    }
}

class INDFarmhousePizza implements Pizza {
    
    public $pizzaName = "Farmhouse Pizza";
    
    public function prepare(){
        print_r("Prepare " . $this->pizzaName . " using suitable ingredients.\n");
    }
    
    public function bake(){
        print_r("Bake pizza at 550 degrees.\n");
    }
    
    public function cut(){
        print_r("Cut the pizza in square shape.\n");
    }
    
    public function box(){
        print_r("Box the pizza properly.\n");
    }
}

// 3. Create Creator class.
class PizzaStore {
    
    public PizzaFactory $factory;
    
    function __construct(PizzaFactory $factory) {
        $this->factory = $factory;
    }
    
    public function orderPizza(string $pizzaType): Pizza{
        $myPizza = $this->factory->createPizza($pizzaType);
        $myPizza->prepare();
        $myPizza->bake();
        $myPizza->cut();
        $myPizza->box();
        return $myPizza;
    }    
}

// 4. Create concreate creator classess.
class NYStylePizzaStore extends PizzaStore {
   function __construct() {
        $factory = new NYStylePizzaFactory();
        parent::__construct($factory);
    }
}

class INDStylePizzaStore extends PizzaStore {

   function __construct() {
        $factory = new INDStylePizzaFactory();
        parent::__construct($factory);
    }
}

//5. Create Factory Interface.
interface PizzaFactory {
    public function createPizza(string $pizzaType);
}

//6. Creare concreate factory classess.
class NYStylePizzaFactory implements PizzaFactory {
    
    public function createPizza(string $pizzaType): Pizza {
        if($pizzaType == 'cheese'){
            $myPizza = new NYCheesePizza();
            $myPizza->pizzaName = "NY Style Cheese Pizza"; 
        }elseif($pizzaType == 'farmehouse'){
            $myPizza = new NYFarmhousePizza();
            $myPizza->pizzaName = "NY Style Farmhouse Pizza";
        }
        return $myPizza;
    }
    
}

class INDStylePizzaFactory implements PizzaFactory {
    
    public function createPizza(string $pizzaType): Pizza {
        if($pizzaType == 'cheese'){
            $myPizza = new INDCheesePizza();
            $myPizza->pizzaName = "IND Style Cheese Pizza"; 
        }elseif($pizzaType == 'farmehouse'){
            $myPizza = new INDFarmhousePizza();
            $myPizza->pizzaName = "IND Style Farmhouse Pizza";
        }
        return $myPizza;
    }
    
}


$pizzaStore = new NYStylePizzaStore();
$myCheesePizza = $pizzaStore->orderPizza("cheese");

echo "\n==================\n";

$pizzaStore = new NYStylePizzaStore();
$myCheesePizza = $pizzaStore->orderPizza("farmehouse");

echo "\n==================\n";

$pizzaStore = new INDStylePizzaStore();
$myCheesePizza = $pizzaStore->orderPizza("cheese");

echo "\n==================\n";

$pizzaStore = new INDStylePizzaStore();
$myCheesePizza = $pizzaStore->orderPizza("farmehouse");

?>
