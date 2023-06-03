<?php
class Singleton {

     public static Singleton $uniqueInstance;

     private function __construct() {}
     
     public static function getInstance(): Singleton {
         if (!isset(self::$uniqueInstance)){
            self::$uniqueInstance = new Singleton();
            echo "One\n";
         }else{
             echo "Another\n";
         }
         return self::$uniqueInstance;
     }
    
    
}

$singleObj = Singleton::getInstance();
$singleObj = Singleton::getInstance();
$singleObj = Singleton::getInstance();
$singleObj = Singleton::getInstance();

print_r($singleObj);

?>