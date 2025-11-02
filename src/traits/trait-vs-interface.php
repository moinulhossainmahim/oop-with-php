<?php

// Example: Interface
interface Loggable {
  public function log(string $message);
}

class FileLogger implements Loggable {
  public function log(string $message) {
    echo "[File] $message\n";
  }
}

// Here, the interface doesn’t provide behavior — it only forces you to define a log() method.
// It’s like a rulebook.

// Example: Trait
trait LogsActivity {
  public function logActivity(string $action) {
    echo "Logging: $action\n";
  }
}

class User {
  use LogsActivity;
}

$user = new User();
$user->logActivity("User created");
