<?php

// 1. Create interface for Subject or Publisher
interface Subject {

    public function Subscribe(Observer $observer);
    public function Unsubscribe(Observer $observer);
    public function Notify();
}

// 2. Create interface for Observer or Subscriber
interface Observer {
    public function Update(Subject $subject);
}

// 3. Create concreate classes for Subject or Publisher. Add various menthods at subject level.
class Newspaper implements Subject {
    private $name;
    private $observers;
    private $content;
    
    function __construct($name) {
        $this->name = $name;
    }
    
    // Add observer to the list.
    public function Subscribe(Observer $observer){
        $this->observers[] = $observer;
    }
    
    // Remove observer from the list.
    public function Unsubscribe(Observer $observer){
        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    // Notify the obervers about the change.
    public function Notify(){
        foreach ($this->observers as $observer) {
            $observer->Update($this);
            
        }
    }
    
    public function setContent($content){
        $this->content = $content;
        $this->Notify();
    }
    
    public function getContent(){
        return $this->content;
    }
    
     public function getName(){
        return $this->name;
    }
}


// 4. Create concreate Observer or Subscriber class
class Reader implements Observer {
    public $name;    
    
    function __construct($name) {
        $this->name = $name;
    }
    
    public function Update(Subject $subject){
        print_r($this->name . " subscribed for " . $subject->getName() . " and reading " . $subject->getContent());
        
    }
}


$tom = new Reader("Tom");
$newyorkTimes = new Newspaper("New York Times");
$newyorkTimes->Subscribe($tom);
$newyorkTimes->setContent("Wonder world");

echo "\n=======\n";

$bob = new Reader("Bob");
$newyorkTimes = new Newspaper("Hindustan Times");
$newyorkTimes->Subscribe($bob);
$newyorkTimes->setContent("Stock story");

?>