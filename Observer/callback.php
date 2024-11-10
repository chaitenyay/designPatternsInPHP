<?php

require_once('paymentAuthorize.php');
require_once('notificationServiceObserver.php');




$txnId = rand(100,1000);
$paymentAuth = new PaymentAuthorize();

$notificationObserver = new NotificationServiceObserver();
$paymentAuth->addSubscriber($notificationObserver);

$notificationObserverNew = new NotificationServiceObserver();
$paymentAuth->addSubscriber($notificationObserverNew);

$paymentAuth->paymentAuthorized($txnId);

$paymentAuth->removeSubscriber($notificationObserverNew);