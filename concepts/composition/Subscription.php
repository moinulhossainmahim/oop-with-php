<?php

class Subscription
{
  protected BillingPortal $billingPortal;

  public function __construct(BillingPortal $billingPortal)
  {
    $this->billingPortal = $billingPortal;
  }

  public function create()
  {
    $customer = $this->billingPortal->getCustomer();
    $subscription = $this->billingPortal->getSubscription();
  }
}

interface BillingPortal
{
  public function getCustomer();
  public function getSubscription();
}

class StripeBillingPortal implements BillingPortal
{
  public function getCustomer()
  {
    /* ... */
  }

  public function getSubscription()
  {
    /* ... */
  }
}

$subscription = new Subscription(
  new StripeBillingPortal()
);

$subscription->create();

/* The Subscription class has a BillingPortal object inside it — that’s composition.
Composition = “a class has another class.”
Relationship: Subscription has a BillingPortal
Inheritance = “a class is a kind of another class.” */
