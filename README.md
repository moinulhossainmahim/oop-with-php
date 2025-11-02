# Object-Oriented Programming (OOP) Concepts in PHP

A comprehensive repository demonstrating fundamental Object-Oriented Programming concepts using PHP. This repository serves as a learning resource and reference guide for understanding OOP principles through practical, real-world examples.

## 📚 Table of Contents

- [About This Repository](#about-this-repository)
- [OOP Concepts Covered](#oop-concepts-covered)
- [Getting Started](#getting-started)
- [Concepts Overview](#concepts-overview)
  - [Inheritance](#inheritance)
  - [Abstraction](#abstraction)
  - [Interfaces](#interfaces)
  - [Traits](#traits)
  - [Composition](#composition)
  - [Static Methods & Properties](#static-methods--properties)
- [Access Modifiers](#access-modifiers)
- [Magic Methods](#magic-methods)
- [Namespaces](#namespaces)
- [Code Examples](#code-examples)
- [Best Practices](#best-practices)
- [Contributing](#contributing)

## 🎯 About This Repository

This repository is designed to help developers understand and master Object-Oriented Programming concepts in PHP. Each concept is demonstrated with clear, practical examples that you can run and experiment with. Whether you're a beginner learning OOP for the first time or an experienced developer looking for a quick reference, this repository provides valuable insights into:

- How OOP principles work in PHP
- Real-world use cases for each concept
- Best practices and patterns
- Code organization techniques

## 🚀 Getting Started

### Prerequisites

- PHP 7.4 or higher
- Basic understanding of PHP syntax
- Composer (optional, for some examples)

### Running Examples

1. Clone this repository:
```bash
git clone <repository-url>
cd oop
```

2. Navigate to any concept folder:
```bash
cd concepts/inheritance
```

3. Run PHP files directly:
```bash
php Model.php
```

## 📖 OOP Concepts Covered

This repository covers the following core OOP concepts:

1. **Inheritance** - Code reusability through parent-child relationships
2. **Abstraction** - Hiding implementation details with abstract classes
3. **Interfaces** - Defining contracts that classes must implement
4. **Traits** - Horizontal code reuse and shared behavior
5. **Composition** - Building complex objects by combining simpler ones
6. **Static Methods & Properties** - Class-level functionality and utilities

## 💡 Concepts Overview

### Inheritance

**Location:** `concepts/inheritance/`

Inheritance allows a class to inherit properties and methods from another class, promoting code reusability and establishing an "is-a" relationship.

**Key Benefits:**
- Code reusability
- Method overriding
- Polymorphism
- Organized class hierarchy

**Files:**
- `Employee.php` - **Recommended for beginners** - Real-world Employee/Developer/Manager hierarchy demonstrating inheritance clearly
- `Model.php` - Demonstrates base Model class with inheritance and protected properties
- `Notification.php` - Shows method overriding with EmailNotification extending Notification

**Example (from Employee.php):**
```php
// Base class - common behavior for all employees
class Employee {
    protected $name;
    protected $id;
    protected $salary;

    public function work() {
        return "{$this->name} is working on general tasks.";
    }
}

// Child class - inherits from Employee
class Developer extends Employee {
    private $language;

    // Override parent method
    public function work() {
        return "{$this->name} is writing {$this->language} code.";
    }
    
    // Developer-specific method
    public function debugCode() {
        return "{$this->name} is debugging code.";
    }
}
```

### Abstraction

**Location:** `concepts/abstract/`

An abstract class is a blueprint for other classes. It cannot be instantiated directly — only extended.

**It's used when:**
- You want to define a common base behavior (some logic shared by all subclasses)
- But you also want to force subclasses to implement specific methods that differ

An abstract class defines a template that other classes must follow. It can include both implemented methods and concrete methods (declared but not implemented). Classes that extend it must implement all abstract methods.

**Key Characteristics:**
- Cannot be instantiated directly
- Can contain both abstract and concrete methods
- Forces child classes to implement abstract methods
- Great for template method patterns

**Files:**
- `Controller.php` - Base controller with shared response methods
- `Model.php` - Abstract base model with common traits and behaviors
- `Payment.php` - Payment gateway with template method pattern

**Example:**
```php
abstract class PaymentGateway {
    public function process() {
        $this->connect();
        $this->pay();
        $this->disconnect();
    }
    
    abstract protected function pay();
}

class StripeGateway extends PaymentGateway {
    protected function pay() {
        echo "Processing Stripe payment...\n";
    }
}
```

### Interfaces

**Location:** `concepts/interface/`

Interfaces define contracts that classes must follow. They specify what methods a class must implement without providing the implementation itself.

**Key Points:**
- It defines what methods a class must implement — but not how they work
- Only constants are allowed as properties
- Multiple interfaces can be implemented by a single class
- It's used to decouple code and enforce consistency
- All methods are implicitly abstract (no implementation)
- Enforces consistent behavior across different classes

**Files:**
- `Payment.php` - Payment gateway interface with multiple implementations
- `Template.php` - Template interface demonstrating required method implementation
- `WithAbstractExample.php` - Interface implementation using abstract classes

**Example:**
```php
interface PaymentGateway {
    public function charge(float $amount);
    public function refund(string $transactionId);
}

class StripePayment implements PaymentGateway {
    public function charge(float $amount) {
        echo "Charging \${$amount} via Stripe\n";
    }
    
    public function refund(string $transactionId) {
        echo "Refunding {$transactionId} via Stripe\n";
    }
}
```

### Traits

**Location:** `concepts/traits/`

A Trait is a mechanism for code reuse in single inheritance languages like PHP. It allows you to inject reusable methods into multiple unrelated classes without using inheritance.

**Why Traits Exist (The Real Problem They Solve)**

PHP supports single inheritance — a class can only extend one parent class. But what if you want to reuse logic across multiple unrelated classes?

For example:
- You want to reuse a `log()` method in multiple classes (User, Product, Order)
- You don't want them all to extend a BaseLogger class (that would be wrong semantically)

Some people refer to traits as **"like an automatic CTRL+C/CTRL+V for your classes"**. You specify some methods in a trait and "import" them into your class. It will make your code behave like the methods were written inside your class.

**Key Characteristics:**
- Can be used by multiple classes
- Provides actual method implementations
- Helps avoid limitations of single inheritance
- Ideal for cross-cutting concerns
- Can have properties and method implementations
- Supports code reuse and composition

**Files:**
- `ApiResponse.php` - API response formatting trait for controllers
- `logger.php` - Logging functionality trait
- `trait-vs-interface.php` - Comparison between traits and interfaces

**Example:**
```php
trait ApiResponse {
    protected function success($data = null, $message = 'Success') {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }
}

class UserController extends Controller {
    use ApiResponse;
    
    public function index() {
        return $this->success($users, 'Fetched users');
    }
}
```

### Composition

**Location:** `concepts/composition/`

Composition is an OOP design principle where objects are built by combining other objects, instead of relying on inheritance.

**Key Points:**
- Promotes flexibility, modularity, and testability
- Frameworks like Laravel use composition everywhere — controllers have services, mailers have transports, and jobs have queues
- It's the foundation of dependency injection and design patterns like Decorator and Strategy
- More flexible than inheritance
- Easier to change behavior at runtime
- Avoids deep inheritance hierarchies
- Follows "favor composition over inheritance" principle

**Files:**
- `Subscription.php` - Demonstrates composition with BillingPortal dependency

**Example:**
```php
class Subscription {
    protected BillingPortal $billingPortal;
    
    public function __construct(BillingPortal $billingPortal) {
        $this->billingPortal = $billingPortal;
    }
}

// Composition = "a class has another class"
// Inheritance = "a class is a kind of another class"
```

### Static Methods & Properties

**Location:** `concepts/static-methods/`

A static method belongs to the class itself, not to any specific object (instance). You call it using the class name — not `$object->method()`, but `ClassName::method()`.

**Key Characteristics:**
- Accessed using `Class::method()` syntax
- Shared across all instances
- Useful for utility functions
- Cannot use `$this` (no instance available)
- Can be overridden in subclasses

**Q: Can static methods use `$this`?**
**A:** No. `$this` refers to the current object instance, and static methods don't have one.

**Q: What is "Late Static Binding"?**
**A:** When we use `static::`, PHP resolves it dynamically at runtime to the calling class, not the class where it's defined.

**`self::` vs `static::` - Common Interview Question:**

| Keyword | Resolution | When Used |
|---------|-----------|-----------|
| `self::` | Refers to the class where it's written (compile-time) | Non-inheritable, fixed to the class definition |
| `static::` | Refers to the class that's calling it (runtime) | Inheritable, late static binding |

**Files:**
- `counter.php` - Static property for counting instances
- `validation.php` - Static utility methods for validation
- `late-static-binding.php` - Demonstrates late static binding concept

**Example:**
```php
class Student {
    public static $count = 0;
    
    public function __construct($name) {
        self::$count++;
        $this->name = $name;
    }
    
    public static function getCount() {
        return self::$count;
    }
}

// Access without instantiation
echo "Total students: " . Student::$count . "\n";
echo "Count via method: " . Student::getCount() . "\n";
```

**Late Static Binding Example:**
```php
class A {
    public static function who() {
        echo __CLASS__;
    }
    
    public static function test() {
        self::who();   // Always outputs "A"
        static::who(); // Late static binding - outputs calling class
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}

B::test(); // Output: AB (self:: = A, static:: = B)
```

## 🔐 Access Modifiers

Access modifiers control the visibility and accessibility of properties and methods in PHP classes. Understanding when to use each modifier is crucial for proper encapsulation and object-oriented design.

### Public

**`public`** is used when you want a property or method to be accessible from anywhere — both inside and outside the class.

It defines the external API of your class — the methods and properties other parts of the system are allowed to use. In real-world frameworks (like Laravel or Symfony), all public methods in controllers or services form the class's "contract" — these are the endpoints other code can safely call.

```php
class User {
    public $name;  // Accessible from anywhere
    
    public function getName() {
        return $this->name;  // Can be called from outside
    }
}

$user = new User();
$user->name = "John";        // ✓ Allowed
echo $user->getName();       // ✓ Allowed
```

### Protected

**`protected`** is used when you want to hide a property or method from external code, but still allow subclasses to access or override it.

It's common in frameworks for base classes that define reusable patterns, where child classes need to extend or customize internal behavior without exposing those internals publicly.

```php
class Vehicle {
    protected $speed;  // Hidden from outside, but accessible in child classes
    
    protected function accelerate() {
        // Child classes can use or override this
    }
}

class Car extends Vehicle {
    public function drive() {
        $this->speed = 60;      // ✓ Can access protected property
        $this->accelerate();    // ✓ Can call protected method
    }
}

$car = new Car();
$car->speed = 100;              // ✗ Error: Cannot access protected property
```

### Private

**`private`** is used when a property or method should be completely hidden from outside access, including child classes.

It's for internal implementation details that must never be overridden or exposed — used to enforce strict encapsulation and prevent misuse or accidental modification of internal state.

```php
class BankAccount {
    private $balance = 0;  // Completely hidden, even from child classes
    
    private function validateAmount($amount) {
        // Internal validation logic
        return $amount > 0;
    }
    
    public function deposit($amount) {
        if ($this->validateAmount($amount)) {  // Only accessible within this class
            $this->balance += $amount;
        }
    }
}

class SavingsAccount extends BankAccount {
    public function getBalance() {
        return $this->balance;  // ✗ Error: Cannot access private property
    }
}

$account = new BankAccount();
$account->balance = 1000;       // ✗ Error: Cannot access private property
```

### Summary Table

| Modifier | Class Itself | Child Classes | Outside Code | Use Case |
|----------|--------------|---------------|--------------|----------|
| **public** | ✓ | ✓ | ✓ | External API, methods meant to be called by other code |
| **protected** | ✓ | ✓ | ✗ | Internal implementation shared with child classes |
| **private** | ✓ | ✗ | ✗ | Internal details that must never be exposed |

## 🪄 Magic Methods

Magic methods are special methods in PHP that are automatically called in response to certain events or actions. They always start with double underscores (`__`).

Below are the three most commonly used magic methods:

### `__construct()`

**When called:** Automatically when an object is created.

**Use:** Initialize object properties or inject dependencies.

**Real-world:** Setting up models, database connections, or configs.

```php
class User {
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
        echo "User {$this->name} created\n";
    }
}

$user = new User("John"); // Automatically calls __construct()
```

### `__destruct()`

**When called:** When the object is destroyed or script ends.

**Use:** Cleanup logic — close connections, delete temp files, release resources.

**Real-world:** Close file handles, DB connections, or log object destruction.

```php
class DatabaseConnection {
    public function __destruct() {
        echo "Closing database connection...\n";
        // Cleanup code here
    }
}
```

### `__invoke()`

**When called:** When an object is used like a function (`$obj()`).

**Use:** Make objects callable, ideal for single-action classes.

**Real-world:** Laravel single-action controllers (`Route::get('list', Controller::class)`).

```php
class SingleActionController {
    public function __invoke($request) {
        return "Handled request";
    }
}

$controller = new SingleActionController();
$result = $controller(); // Calls __invoke()
```

### Other Magic Methods

PHP provides many more magic methods for advanced use cases. For a complete list and detailed documentation, visit:

**[PHP Official Documentation - Magic Methods](https://www.php.net/manual/en/language.oop5.magic.php)**

Some other commonly used magic methods include:
- `__get()` - Accessing undefined or private properties
- `__set()` - Writing to undefined or private properties
- `__call()` - Calling undefined instance methods
- `__callStatic()` - Calling undefined static methods
- `__toString()` - Converting object to string
- `__clone()` - Object cloning
- `__sleep()` / `__wakeup()` - Serialization
- And more...

## 📦 Namespaces

A namespace in PHP is a way to group related classes, interfaces, traits, functions, or constants under a unique name. It helps avoid naming conflicts and organizes code logically.

**Why Namespaces Matter:**

Laravel relies heavily on namespaces to map its directory structure to PHP class names, enabling automatic dependency injection, autoloading, and clean architecture.

### Basic Namespace Usage

```php
namespace App\Http\Controllers;

class UserController {
    // ...
}

// Using the class
$controller = new \App\Http\Controllers\UserController();
```

### Using Statements

```php
namespace App\Services;

use App\Http\Controllers\UserController;
use App\Models\User as UserModel;

class UserService {
    public function __construct(UserController $controller) {
        // ...
    }
}
```

### Autoloading with Composer

In `composer.json`, you can define PSR-4 autoloading:

```json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/"
    }
  }
}
```

**What this means:** When Composer sees `App\Something`, it will look for that class inside the `app/` folder. This tells Composer: "When I see `App\Something`, look for that class inside the `app/` folder."

### Directory Structure Mapping

With PSR-4 autoloading, the namespace structure matches the directory structure:

```
app/
├── Http/
│   └── Controllers/
│       └── UserController.php  → namespace App\Http\Controllers;
├── Models/
│   └── User.php                 → namespace App\Models;
└── Services/
    └── UserService.php          → namespace App\Services;
```

### Benefits

1. **Avoid Naming Conflicts:** Different namespaces can have classes with the same name
2. **Organize Code:** Logical grouping of related classes
3. **Autoloading:** Automatic class loading based on namespace
4. **Framework Integration:** Essential for Laravel, Symfony, and other modern PHP frameworks

## 🔍 Code Examples

Each concept folder contains working PHP examples that you can run and modify:

```
concepts/
├── abstract/          # Abstract classes and methods
├── composition/       # Composition patterns
├── inheritance/       # Class inheritance examples
├── interface/         # Interface implementations
├── static-methods/    # Static methods and properties
└── traits/            # Trait usage examples
```

### Running Examples

Navigate to any concept folder and run the PHP files:

```bash
cd concepts/inheritance
php Model.php

cd concepts/interface
php Payment.php

cd concepts/traits
php ApiResponse.php
```

## 🎓 Key Differences

### Interface vs Abstract Class

| Feature | Interface | Abstract Class |
|---------|-----------|----------------|
| Instantiation | Cannot be instantiated | Cannot be instantiated |
| Methods | Only abstract methods | Can have abstract and concrete methods |
| Properties | Constants only | Can have properties |
| Multiple Inheritance | Yes (multiple interfaces) | No (single inheritance) |
| Access Modifiers | Public only | Can have protected/private |
| Use Case | Define contracts | Shared code with required implementations |

### Trait vs Interface

| Feature | Trait | Interface |
|---------|-------|-----------|
| **Purpose** | Share reusable code (behavior) | Define a contract (what must be implemented) |
| **Implementation** | Actual method implementations + properties | Only method signatures (no code) |
| **Multiple Usage** | Yes | Yes |
| **Properties** | Can have properties | Constants only |
| **Constructor** | Can have constructor | No constructor |
| **Use Case** | Code reuse and composition | Enforcing structure and consistency |

### Composition vs Inheritance

| Feature | Composition | Inheritance |
|---------|-------------|-------------|
| Relationship | "has-a" | "is-a" |
| Flexibility | High (runtime changeable) | Low (compile-time) |
| Coupling | Loose | Tight |
| Use Case | Prefer when relationship is dynamic | Prefer when relationship is permanent |

## 📝 Best Practices

1. **Use Inheritance** when you have a clear "is-a" relationship and want to share code
2. **Use Composition** when you need flexibility and want to change behavior at runtime
3. **Use Interfaces** to define contracts and enforce consistent behavior
4. **Use Traits** for horizontal code reuse when inheritance doesn't fit
5. **Use Abstract Classes** when you need to share code and enforce method implementation
6. **Prefer Composition over Inheritance** for better flexibility and maintainability
7. **Keep Inheritance Hierarchies Shallow** - avoid deep inheritance chains
8. **Use Static Methods** for utility functions that don't require instance state

## 🤝 Contributing

Contributions are welcome! If you'd like to improve examples or add new concepts:

1. Fork the repository
2. Create a feature branch
3. Add your examples with clear comments
4. Submit a pull request

## 📄 License

This repository is for educational purposes. Feel free to use and modify the code examples.

## 🔗 Additional Resources

- [PHP Official Documentation - OOP](https://www.php.net/manual/en/language.oop5.php)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [Design Patterns](https://refactoring.guru/design-patterns)

---

**Happy Learning! 🚀**

*This repository is maintained for educational purposes. If you find it helpful, consider giving it a star!*

