<?php

// 1. Create Product interface
interface Pizza {
    public function prepare();
    public function bake();
    public function cut();
    public function box();
}

//2. Create the concreate product classess
class CheesePizza implements Pizza {
    
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

class FarmhousePizza implements Pizza {
    
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

// 3. Create abstract Creator class.
abstract class PizzaStore {
    public function orderPizza(string $pizzaType): Pizza{
        $myPizza = $this->createPizza($pizzaType);
        $myPizza->prepare();
        $myPizza->bake();
        $myPizza->cut();
        $myPizza->box();
        return $myPizza;
    }
    
    // 4. Add abstract factory method to the creator class.
    abstract public function createPizza(string $pizzaType): Pizza;

}

// 5. Create concreate creator classess.
class NYStylePizzaStore extends PizzaStore {

    // 6. Implement fatory method in concreate creator class.
    public function createPizza(string $pizzaType): Pizza {
        if($pizzaType == 'cheese'){
            $myPizza = new CheesePizza();
            $myPizza->pizzaName = "NY Style Cheese Pizza"; 
        }elseif($pizzaType == 'farmehouse'){
            $myPizza = new FarmhousePizza();
            $myPizza->pizzaName = "NY Style Farmhouse Pizza";
        }
        return $myPizza;
    }
}

class INDStylePizzaStore extends PizzaStore {

    // 6. Implement fatory method in concreate creator class.
    public function createPizza(string $pizzaType): Pizza {
        if($pizzaType == 'cheese'){
            $myPizza = new CheesePizza();
            $myPizza->pizzaName = "IND Style Cheese Pizza"; 
        }elseif($pizzaType == 'farmehouse'){
            $myPizza = new FarmhousePizza();
            $myPizza->pizzaName = "IND Style Farmhouse Pizza";
        }
        return $myPizza;
    }
}

$pizzaStore = new NYStylePizzaStore();
$myCheesePizza = $pizzaStore->orderPizza("cheese");

$pizzaStore = new INDStylePizzaStore();
$myFarmhousePizza = $pizzaStore->orderPizza("farmehouse");

?>
