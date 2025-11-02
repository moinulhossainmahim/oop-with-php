<?php

abstract class PaymentGateway {
  public function process() {
    $this->connect();
    $this->pay();
    $this->disconnect();
  }

  protected function connect() {
    echo "Connecting to gateway...\n";
  }

  protected function disconnect() {
    echo "Disconnecting...\n";
  }

  abstract protected function pay();
}

class StripeGateway extends PaymentGateway {
  protected function pay() {
    echo "Processing Stripe payment...\n";
  }
}

$gateway = new StripeGateway(); // NB: Abstract class can't be instantiated i.e new PaymentGateway() is not allowed.
$gateway->process();
