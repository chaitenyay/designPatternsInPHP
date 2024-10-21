<?php

// Singleton class
class Singleton{

    // Static variable to hold the singleton instance.
    private static $instance;

    // Private constructor to prevent other class from instantiating 
    private function __construct(){

    }

    // Static method to create singleton instance.
    public static function getInstance(): Singleton{

        if(!isset(self::$instance)){
            self::$instance = new Singleton();
        }
        return self::$instance;

    }


}

$obj = Singleton::getInstance();
$objNew = Singleton::getInstance();

if($obj === $objNew){
    echo "Same object";
}else{
    echo "Not a same object";
}

