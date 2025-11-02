<?php

trait LoggerTrait {
    public function log(string $message) {
        echo "[" . date('Y-m-d H:i:s') . "] $message\n";
    }
}

class User {
    use LoggerTrait;

    public function register() {
        $this->log("User registered successfully!");
    }
}

class Product {
    use LoggerTrait;

    public function add() {
        $this->log("Product added successfully!");
    }
}

$user = new User();
$user->register();

$product = new Product();
$product->add();
