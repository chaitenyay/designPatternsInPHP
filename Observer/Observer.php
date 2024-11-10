<?php

interface iSubject {

    public function addObserver(iObserver $iObserver);
    public function removeObserver(iObserver $iObserver);

    public function notify($productId);

    public function setData($productId);
}

class productSubject implements iSubject {

    public $listObserver = [];

    public function addObserver(iObserver $iObserver){
        $this->listObserver[$iObserver->productId][] = $iObserver;
    }
    public function removeObserver(iObserver $iObserver){
        // Logic to remove observer
    }

    public function notify($productId){
        foreach($this->listObserver[$productId] as $observerObj){
                $observerObj->update();
        }                
    }

    public function setData($productId){
        $this->notify($productId);
    }

}


interface iObserver {
    public function update();

}

class productObserver implements iObserver {

    public $productId;
    public $userId;

    public function __construct($userId, $productId){
        $this->userId = $userId;
        $this->productId = $productId;
    }

    public function update()
    {
        print_r("Update to user " . $this->userId . " for the product Id: " . $this->productId . " \n");
    }


}

$prodObserverObjA = new productObserver(1,1);
$prodObserverObjB = new productObserver(2,1);
$prodObserverObjC = new productObserver(3,1);
$prodObserverObjD = new productObserver(4,2);
$prodObserverObjF = new productObserver(5,2);
// $prodObserverObjF->update();

$prodSubjectObj= new productSubject();
$prodSubjectObj->addObserver($prodObserverObjA);
$prodSubjectObj->addObserver($prodObserverObjB);
$prodSubjectObj->addObserver($prodObserverObjC);
$prodSubjectObj->addObserver($prodObserverObjD);
$prodSubjectObj->addObserver($prodObserverObjF);

$productId = 1;
$prodSubjectObj->setData($productId);

$productId = 2;
$prodSubjectObj->setData($productId);



