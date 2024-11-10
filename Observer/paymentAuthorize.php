<?php

require_once('paymentSubject.php');



class PaymentAuthorize implements iPaymentSubject {

    public $listSubscribers = [];
    public $txnId;


    public function addSubscriber(iPaymentSubscriber $subscriber){
        $this->listSubscribers[] = $subscriber;

    }
    public function removeSubscriber(iPaymentSubscriber $subscriber){
        $index = array_search($subscriber, $this->listSubscribers);
        if ($index !== false) {
            unset($this->listSubscribers[$index]);
            print_r("Successfully unsubscribed: ".get_class($subscriber)."\n");
        }
    }
    public function notifySubscriber(){
        print_r("Send notification to the subscribers: \n");
        foreach($this->listSubscribers as $subscriber){
            $subscriber->update($this->txnId);
        }
    }

    public function paymentAuthorized($txnId){
        $this->txnId = $txnId;
        print_r("Payment authorized for txn ID: " . $this->txnId . "\n");

        $this->notifySubscriber();

    }

}

