<?php

interface MainPaymentGateway {
  public function charge(float $amount);
  public function refund(string $transactionId);
}

class StripePayment implements MainPaymentGateway {
  public function charge(float $amount) {
      echo "Charging \${$amount} via Stripe\n";
  }

  public function refund(string $transactionId) {
      echo "Refunding {$transactionId} via Stripe\n";
  }
}

// Can implement many interfaces in OOP.
class PayPalPayment implements MainPaymentGateway {
  public function charge(float $amount) {
      echo "Charging \${$amount} via PayPal\n";
  }

  public function refund(string $transactionId) {
      echo "Refunding {$transactionId} via PayPal\n";
  }
}
