<?php

require_once('paymentSubscriber.php');

class NotificationServiceObserver implements iPaymentSubscriber {

    public function update($txnId){
        print_r("Payment has been autorized for txn ID: " . $txnId . "\n");
    }

}