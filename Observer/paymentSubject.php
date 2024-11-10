<?php

require_once('paymentSubscriber.php');
interface iPaymentSubject {
    public function addSubscriber(iPaymentSubscriber $subscriber);
    public function removeSubscriber(iPaymentSubscriber $subscriber); 
    public function notifySubscriber(); 


}