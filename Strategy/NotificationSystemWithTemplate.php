<?php

interface iNotificationStrategy {

    public function notify();

}

class WhatsAppNotification implements iNotificationStrategy {

    private $templateStrategy;

    public function __construct(iTemplateStrategy $templateStrategy){
        $this->templateStrategy = $templateStrategy;

    }

    public function notify(){
        $message = $this->templateStrategy->generateMessage($this->templateStrategy->data);
        print_r("Notification sent via WhatsApp.\n");
        print_r($message);
        print_r("\n-----------.\n");
    }

}


class EmailNotification implements iNotificationStrategy {

    private $templateStrategy;

    public function __construct(iTemplateStrategy $templateStrategy){
        $this->templateStrategy = $templateStrategy;

    }

    public function notify(){
        $message = $this->templateStrategy->generateMessage($this->templateStrategy->data);
        print_r("Notification sent via Email.\n");
        print_r($message);
        print_r("\n-----------.\n");
    }
}

class SMSNotification implements iNotificationStrategy {

    private $templateStrategy;

    public function __construct(iTemplateStrategy $templateStrategy){
        $this->templateStrategy = $templateStrategy;

    }

    public function notify(){
        $message = $this->templateStrategy->generateMessage($this->templateStrategy->data);
        print_r("Notification sent via SMS.\n");
        print_r($message);
        print_r("\n-----------.\n");
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

// Template Strategy Interface
interface iTemplateStrategy {
    public function generateMessage();
}

// Concrete Template for Email Notifications
class EmailTemplate implements iTemplateStrategy {

    public $data;

    public function __construct($data){
        $this->data = $data;
    }
    public function generateMessage() {
        return "Subject: " . $this->data['subject'] . "\n" .
               "Body: <html><body>" . $this->data['message'] . "</body></html>\n" .
               "Footer: Thank you for using our service!";
    }
}

// Concrete Template for SMS Notifications
class SMSTemplate implements iTemplateStrategy {

    public $data;

    public function __construct($data){
        $this->data = $data;
    }
    public function generateMessage() {
        return "SMS: " . $this->data['message'];
    }
}

// Concrete Template for Push Notifications
class WhatsAppNotificationTemplate implements iTemplateStrategy {

    public $data;

    public function __construct($data){
        $this->data = $data;
    }
    public function generateMessage() {
        return "Title: " . $this->data['title'] . "\nMessage: " . $this->data['message'];
    }
}


// Example Usage
$data = [
    'subject' => 'Your Order Update',
    'message' => 'Your order #1234 has been shipped!',
    'title' => 'Order Update'
];

$notificationObj = new NotificationSystem(new WhatsAppNotification(new WhatsAppNotificationTemplate($data)));
$notificationObj->sendNotification();

$notificationObj->setNotificationStrategy(new SMSNotification(new SMSTemplate($data)));

$notificationObj->sendNotification();
