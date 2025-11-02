<?php

// Method overriding

class Notification {
  public $message;

  public function __construct(string $message) {
      $this->message = $message;
  }

  public function send() {
      echo "Show flash message: " . $this->message;
  }
}

class EmailNotification extends Notification {
  public function send() {
      echo "Fire off an email notification: " . $this->message;
  }
}

$notification = new Notification("Notification sent\n");
$notification->send();

$emailNotification = new EmailNotification("Email notification sent");
$emailNotification->send();
