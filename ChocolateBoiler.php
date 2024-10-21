<?php
//Singleton class
class Singleton{

    /**
    * Static variable array to hold multiple class instances
    */
    private static $instance = [];

    /**
    * Unique ID, to distingues various singleton objects even for the same class (Pool Concept)
    */
    private static $uId = '';

    /**
    * Private constructor to prevent instantiating from other classes.
    */
    private function __construct(){
    }

     /**
     * Singletons should not be cloneable.
     */
    protected function __clone() { }

    /**
     * Singletons should not be restorable from strings.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    // Static method to create singleton instance. Here static keyword refer to the child class.
    public static function getInstance($uId = ''): mixed{

        $subclass = static::class;
        if(isset($uId)){
            self::$uId = $uId;
        }
        
        if(!isset(self::$instance[$subclass.self::$uId])){
            self::$instance[$subclass.self::$uId] = new static(self::$uId);
        }   
        
        return self::$instance[$subclass.self::$uId];
    }
}

interface iBoiler{

    public function isEmpty();
    public function isBoiled();
    public function getBoilerId();
    
    public function fill();
    public function boil();
    public function drain();

}

class ChocolateBoiler extends Singleton implements iBoiler {

    private bool $empty;
    
    private bool $boiled;

    // Boiler ID, to distingues multiple boilers.
    private string $boilerId;

    protected function __construct($boilerId = ''){
        echo "Constructor\n";
        $this->empty = true;
        $this->boiled = false;
        $this->boilerId = $boilerId;
    }


    public function isEmpty(): bool{
        return $this->empty;
    }

    public function isBoiled(): bool{
        return $this->boiled;
    }

    public function getBoilerId(): string{
        return $this->boilerId;
    }
    


    public function fill(){
        if($this->isEmpty()){
            $this->empty = false;
            $this->boiled = false;
            echo "Chocolate filled: " . $this->getBoilerId() . "\n";
        }else{
            echo "Chocolate already filled: " . $this->getBoilerId() . "\n";
        }
    }

    public function boil(){
        if($this->isEmpty() != true && $this->isBoiled() != true){
            $this->boiled = true;
            echo "Chocolate boiled: " . $this->getBoilerId() . "\n";
        }elseif($this->isEmpty()){
            echo "Empty boiler";
        }else{
            echo "Chocolate already boiled: " . $this->getBoilerId() . "\n";
        }

    }

    public function drain(){
        if($this->isEmpty() != true){
            $this->empty = true;
            $this->boiled = false;
            echo "Chocolate drained: " . $this->getBoilerId() . "\n";
        }else{
            echo "Chocolate already drained: " . $this->getBoilerId() . "\n";
        }

    }

}

// Create singleton instances for each boiler.
// Boiler with ID: 123
$obj = ChocolateBoiler::getInstance(123);
$obj->fill();
$obj->boil();
$obj->drain();

//Another boiler with ID: 234
$objNew = ChocolateBoiler::getInstance(234);
$objNew->fill();
$objNew->boil();
$objNew->drain();
