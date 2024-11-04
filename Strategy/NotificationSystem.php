<?php

interface iNotificationStrategy {

    public function notify();

}

class WhatsAppNotification implements iNotificationStrategy {

    public function notify(){
        print_r("Notification sent via WhatsApp.\n");
    }

}


class EmailNotification implements iNotificationStrategy {

    public function notify(){
        print_r("Notification sent via Email.\n");
    }
}

class SMSNotification implements iNotificationStrategy {

    public function notify(){
        print_r("Notification sent via SMS.\n");
    }
}

class NotificationSystem {

    private $notificationStrategy;

    public function __construct(iNotificationStrategy $notificationStrategy){
        $this->notificationStrategy = $notificationStrategy;
    }

    public function setNotificationStrategy(iNotificationStrategy $notificationStrategy){
        $this->notificationStrategy = $notificationStrategy;
    }


    public function sendNotification(){
        $this->notificationStrategy->notify();
    }

}

$notificationObj = new NotificationSystem(new WhatsAppNotification());
$notificationObj->sendNotification();

$notificationObj->setNotificationStrategy(new SMSNotification());

$notificationObj->sendNotification();
